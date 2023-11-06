<?php

namespace Api\Features\Share\Http;

use OpenApi\Attributes as OA;

#[OA\Schema()]
class FileResponse
{
    #[OA\Property()]
    public string $id;

    #[OA\Property()]
    public string $name;

    #[OA\Property()]
    public string $originalName;

    #[OA\Property()]
    public int $width;

    #[OA\Property()]
    public int $height;

    #[OA\Property()]
    public string $contentType;

    #[OA\Property()]
    public string $description;

    #[OA\Property()]
    public int $size;

    #[OA\Property()]
    public string $src;

    public function __construct(
        string $id,
        string $name,
        string $originalName,
        int $width,
        int $height,
        string $contentType,
        string $description,
        int $size,
        string $src,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->originalName = $originalName;
        $this->width = $width;
        $this->height = $height;
        $this->contentType = $contentType;
        $this->description = $description;
        $this->size = $size;
        $this->src = $src;
    }
}