<?php

namespace Api\Features\Share\Models;
use Api\Features\Share\Mappers\ListQueryMapper;

class ListQueryModel
{
    use ListQueryMapper;
    public array $filter;
    public array $smartFilter;
    public SortParamModel $sort;
    public int $page;
    public int $size;

    public function __construct(
        array          $filter = [],
        array          $smartFilter = [],
        SortParamModel $sort = new SortParamModel(by: '', direction: ''),
        int            $page = 1,
        int            $size = 1,
    )
    {
        $this->sort = $sort;
        $this->page = $page <= 0 ? 1 : $page;
        $this->size = $size <= 0 || $size > 1000 ? 10 : $size;
        $this->filter = $filter;
        $this->smartFilter = $smartFilter;
    }

    public function onlyActive(): static
    {
        $this->filter['ACTIVE'] = 'Y';
        return $this;
    }
}

