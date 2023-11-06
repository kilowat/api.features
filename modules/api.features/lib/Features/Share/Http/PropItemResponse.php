<?php

namespace Api\Features\Share\Http;
use OpenApi\Attributes as OA;

#[OA\Schema()]
class PropItemResponse
{
    public function __construct(
        #[OA\Property()]
        public string $description = '',

        #[OA\Property()]
        public string $value = '',
    )
    {
    }
}