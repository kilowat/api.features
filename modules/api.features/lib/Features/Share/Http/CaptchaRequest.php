<?php

namespace Api\Features\Share\Http;
use Api\Features\Share\Rules\CaptchaRule;
use OpenApi\Attributes as OA;

#[OA\Schema()]
class CaptchaRequest
{
    public function __construct(
        #[OA\Property()]
        public string $word,

        #[OA\Property()]
        public string $ssid,
    )
    {

    }
}