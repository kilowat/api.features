<?php

namespace Api\Features\Share\Http;
use OpenApi\Attributes as OA;

#[OA\Schema()]
class SortResponse
{
    #[OA\Property()]
    public string $code;

    #[OA\Property()]
    public string $name;

    public function __construct(
        string $code,
        string $name,
    )
    {
        $this->code = $code;
        $this->name = $name;
    }
}