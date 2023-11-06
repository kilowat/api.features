<?php

namespace Api\Features\Share\Http;
use OpenApi\Attributes as OA;

#[OA\Schema()]
class SortParamResponse
{


    public function __construct(
        #[OA\Property()]
        public string $by,
        #[OA\Property()]
        public string $direction,
    )
    {

    }
}