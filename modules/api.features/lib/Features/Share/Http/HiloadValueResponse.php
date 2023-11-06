<?php

namespace Api\Features\Share\Http;
use OpenApi\Attributes as OA;

#[OA\Schema()]
class HiloadValueResponse
{
    #[OA\Property()]
    public string $id;

    #[OA\Property()]
    public string $code;

    #[OA\Property()]
    public string $name;

    #[OA\Property()]
    public string $description;

    public function __construct(
        string $id,
        string $code,
        string $name,
        string $description,
    )
    {
        $this->code = $code;
        $this->name = $name;
        $this->description = $description;
    }
}