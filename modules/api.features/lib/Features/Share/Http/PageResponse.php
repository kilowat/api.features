<?php
namespace Api\Features\Share\Http;

use OpenApi\Attributes as OA;

#[OA\Schema()]
class PageResponse
{
    #[OA\Property()]
    public string $code;

    #[OA\Property()]
    public MetaDataResponse $meta;

    #[OA\Property()]
    public string $content;

    #[OA\Property(
        type: 'array',
        items: new OA\Items(ref: BannerResponse::class),
    )]
    public array $banners;

    /**
     * @param string $code
     * @param MetaDataResponse $meta
     * @param string $content
     * @param BannerResponse[] $banners
     */
    public function __construct(
        string $code,
        MetaDataResponse $meta,
        string $content,
        array $banners,
    )
    {
        $this->code = $code;
        $this->meta = $meta;
        $this->content = $content;
        $this->banners = $banners;
    }
}