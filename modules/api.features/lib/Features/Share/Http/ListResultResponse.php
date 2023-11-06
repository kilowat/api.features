<?php
namespace Api\Features\Share\Http;
use OpenApi\Attributes as OA;

#[OA\Schema()]
class ListResultResponse
{
    #[OA\Property(nullable: true)]
    public ?SortParamResponse $sortParam;

    #[OA\Property(
        type: 'array',
        items: new OA\Items(ref: SortResponse::class),
    )]
    public array $sort;

    public array $items;

    #[OA\Property()]
    public PaginationResponse $pagination;

    /**
     * @param SortResponse[] $sort
     * @param ?SortParamResponse $sortParam
     * @param array $items
     * @param PaginationResponse $pagination
     */
    public function __construct(
        array              $items,
        PaginationResponse $pagination,
        array              $sort = [],
        SortParamResponse  $sortParam = null,
    )
    {
        $this->sort = $sort;
        $this->sortParam = $sortParam;
        $this->items = $items;
        $this->pagination = $pagination;
    }
}