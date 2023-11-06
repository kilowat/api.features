<?php

namespace Api\Features\Share\Http;

use Api\Features\Share\Mappers\ListRequestMapper;

class ListRequest
{
    use ListRequestMapper;

    public array $filter;
    public string $orderBy;
    public string $orderDirection;
    public string $pageSize;
    public string $page;

    public function __construct(
        array $filter,
        string $orderBy,
        string $orderDirection,
        string $pageSize,
        string $page,
    )
    {
        $this->filter = $filter;
        $this->orderBy = $orderBy;
        $this->orderDirection = $orderDirection;
        $this->pageSize = $pageSize;
        $this->page = $page;
    }

    public static function fromArray(array $data): static
    {
        return new static(
            filter: $data['filter'] ?? [],
            orderBy: $data['order_by'] ?? '',
            orderDirection: $data['order_direction'] ?? '',
            pageSize: $data['page_size'] ?? '20',
            page: $data['page'] ?? '0',
        );
    }
}