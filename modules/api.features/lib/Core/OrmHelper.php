<?php

namespace Api\Core;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity\ReferenceField;
use Bitrix\Main\ORM\Query\Join;

class OrmHelper
{
    /**
     * Добавляет к сущности orm ссылку на хайлоуд блок
     * @param $entity
     * @param $hlFields
     * @return void
     * @throws \Bitrix\Main\ArgumentException
     * @throws \Bitrix\Main\ObjectPropertyException
     * @throws \Bitrix\Main\SystemException
     */
    public static function compileHighLoadEntities($entity, $hlFields): void
    {
        $elementTableFields = array_flip($hlFields);
        $hlEntities = HL\HighloadBlockTable::getList(['filter' => ['NAME' => $hlFields]])->fetchAll();

        foreach ($hlEntities as $hlEntity) {
            $referenceEntity = HL\HighloadBlockTable::compileEntity($hlEntity);
            $elementTableField = $elementTableFields[$hlEntity['NAME']];
            $refValueEntity = $entity->getField($elementTableField)->getRefEntity();
            $refValueEntity->addField(new ReferenceField(
                'HIGHLOAD',
                $referenceEntity,
                Join::on('this.VALUE', 'ref.UF_XML_ID')
            ));
        }
    }

    public static function getHtmlValue($value)
    {
        if($value == null) return '';

        $htmlValue = unserialize($value);
        return $htmlValue['TEXT'];
    }

    public static function getHiloadItemById($code, $id) : array | false
    {
        $entity = HL\HighloadBlockTable::compileEntity($code);
        return $entity->getDataClass()::getList([
            'filter' => ['ID' => $id],
            'select' => ['*'],
        ])->fetch();
    }
}