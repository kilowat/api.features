<?
use Bitrix\Highloadblock\HighloadBlockTable;
use Bitrix\Main\Entity\Event;
use Bitrix\Main\EventManager;

$eventManager = EventManager::getInstance();

//Чистка кэша
$hArr = [
    'Preferential',
];

$eventManager = EventManager::getInstance();

foreach ( $hArr as $h) {
    $eventManager->addEventHandler('', $h.'OnBeforeAdd', 'OnChange');
    $eventManager->addEventHandler('', $h.'OnBeforeUpdate', 'OnChange');
    $eventManager->addEventHandler('', $h.'OnBeforeDelete', 'OnChange');
}


function OnChange(Event $event): void
{
    global $CACHE_MANAGER;

    $entity = $event->getEntity();

    $hlblock = HighloadBlockTable::query()->addSelect('*')->where('TABLE_NAME', $entity->getDBTableName())->exec()->fetch();
    if ($hlblock['TABLE_NAME'])
        $CACHE_MANAGER->ClearByTag($hlblock['TABLE_NAME']);
}