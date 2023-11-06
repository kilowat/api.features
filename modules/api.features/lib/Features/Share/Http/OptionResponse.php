<?php

namespace Api\Features\Share\Http;
use OpenApi\Attributes as OA;

#[OA\Schema()]
class OptionResponse
{
    public function __construct(
        #[OA\Property()]
        public string $id,
        #[OA\Property()]
        public string $value,
    )
    {
    }
}