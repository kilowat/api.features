<?php

namespace Api\Features\Share\Http;
use OpenApi\Attributes as OA;

#[OA\Schema()]
class PaginationResponse
{
    #[OA\Property(description: 'Всего страниц')]
    public int $total;

    #[OA\Property(description: 'Текущая')]
    public int $current;

    #[OA\Property(description: 'Всего элементов')]
    public int $count;

    #[OA\Property(description: 'Кол-во элементов на страницу')]
    public int $size;

    public function __construct(
        int $total,
        int $current,
        int $count,
        int $size,
    )
    {
        $this->total = $total;
        $this->current = $current;
        $this->count = $count;
        $this->size = $size;
    }
}