<?php

namespace Api\Features\Share\Http;
use OpenApi\Attributes as OA;

#[OA\Schema()]
class MetaDataResponse
{
    #[OA\Property()]
    public string $title;

    #[OA\Property()]
    public string $description;

    public function __construct(
        string $title,
        string $description,
    )
    {
        $this->title = $title;
        $this->description = $description;
    }

    public static function empty()
    {
        return new static(title: '', description: '');
    }
}