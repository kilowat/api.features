<?php

namespace Api\Features\Share\Models;

use Api\Features\Share\Attributes\SortSchema;

class ListResultModel
{
    public ListQueryModel $query;
    public array $items;
    public PaginationModel $pagination;

    /**
     * @param ListQueryModel $query
     * @param array $items
     * @param PaginationModel $pagination
     */
    public function __construct(
        ListQueryModel  $query,
        array           $items,
        PaginationModel $pagination,
    )
    {
        $this->query = $query;
        $this->items = $items;
        $this->pagination = $pagination;
    }

    public static function empty(): static
    {
        return new static(
            query: new ListQueryModel(),
            items: [],
            pagination: PaginationModel::empty(),
        );
    }

    public function getSort(): SortSchema
    {
        return SortSchema::fromAttribute(static::class);
    }
}