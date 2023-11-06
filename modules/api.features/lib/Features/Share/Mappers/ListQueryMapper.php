<?php

namespace Api\Features\Share\Mappers;

trait ListQueryMapper
{
    public function filterToIds(int|string $blockId): array
    {
        if(empty($this->smartFilter)) return [];

        $queryFilter = [...$this->smartFilter, 'IBLOCK_ID' => $blockId];
        $res = \CIBlockElement::GetList(
            Array(),
            $queryFilter,
            false,
            false,
            ["ID"]);
        while ($ob = $res->GetNextElement()) {
            $arFields = $ob->GetFields();
            $ids['ID'][] = $arFields["ID"];
        }
        return $ids;
    }
    public function toArNavStartParams(): array
    {
        return [
            'iNumPage' => $this->page,
            'nPageSize' => $this->size,
        ];
    }
}
