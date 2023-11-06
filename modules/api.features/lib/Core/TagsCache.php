<?php

namespace Api\Core;

use Bitrix\Iblock\PropertyTable;
use Bitrix\Main\Application;
use Bitrix\Main\Data\Cache;

trait TagsCache
{
    private function getLinked($iblockId): array
    {
        $arProps = PropertyTable::getList(array(
            'select' => array('*'),
            'filter' => array('IBLOCK_ID' => $iblockId)
        ))->fetchCollection();
        $linked = [];
        foreach ($arProps as $prop) {
            $propType = $prop->getPropertyType();
            $userType = $prop->getUserType();
            if($userType == 'directory') {
                $settings = unserialize($prop->getUserTypeSettings());
                $table = $settings['TABLE_NAME'];
                $linked[] = $table;
            }
            if($propType == 'E') {
                $linked[] = 'iblock_id_'.$prop->getIblockId();
            }
        }
        return $linked;
    }

    public function toCache(
        callable $callback,
        string $cacheKey,
        string $cachePath,
        array $iblockIdS,
        bool $useLinkedProps = true,
        int $cacheTtl = 36000
    ): mixed
    {
        $cache = Cache::createInstance();
        $taggedCache = Application::getInstance()->getTaggedCache();

        if ($cache->initCache($cacheTtl, $cacheKey, $cachePath))
        {
            return $cache->getVars();
        }
        elseif ($cache->startDataCache())
        {
            $taggedCache->startTagCache($cachePath);
            $vars = $callback();
            foreach ($iblockIdS as $iblockId) {
                $taggedCache->registerTag('iblock_id_'.$iblockId);
                if($useLinkedProps) {
                    $arrLinked = $this->getLinked($iblockId);
                    foreach ($arrLinked as $tag) {
                        $taggedCache->registerTag($tag);
                    }
                }
            }
            $taggedCache->endTagCache();
            $cache->endDataCache($vars);
            return $vars;
        }
        return null;
    }
}