<?php

namespace Api\Features\Share\Http;
use OpenApi\Attributes as OA;

#[OA\Schema()]
class CaptchaResponse
{
    public function __construct(
        #[OA\Property()]
        public string $ssid,

        #[OA\Property()]
        public string $picture,
    )
    {
    }
}