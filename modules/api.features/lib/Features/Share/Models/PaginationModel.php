<?php

namespace Api\Features\Share\Models;

use Api\Features\Share\Mappers\PaginationMapper;

class PaginationModel
{
    use PaginationMapper;

    public readonly int $total;
    public readonly int $current;
    public readonly int $count;
    public int $size = 20;

    public function __construct(
        $total,
        $current,
        $count,
        $size,
    )
    {
        $this->total =  $total < 0 ? 0 : $total;
        $this->current = $current < 0 ? 0 : $current;
        $this->count = $count < 0 ? 0 : $count;
        $this->size = $size <=0 ? 1 : $size;
    }

    public static function empty(): static
    {
        return new static(total: 0, current: 0, count: 0, size: 20);
    }

    public static function fromResult(\CIBlockResult $result): PaginationModel
    {
        return new PaginationModel(
            total: $result->NavPageCount,
            current: $result->NavPageNomer,
            count: $result->NavRecordCount,
            size: $result->NavPageSize,
        );
    }

    public static function FromNav(\Bitrix\Main\UI\PageNavigation $nav)
    {
        return new PaginationModel(
            total: $nav->getPageCount(),
            current: $nav->getCurrentPage(),
            count: $nav->getRecordCount() ?? 0,
            size: $nav->getPageSize(),
        );
    }
}