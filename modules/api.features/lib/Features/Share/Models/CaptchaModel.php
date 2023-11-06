<?php

namespace Api\Features\Share\Models;

use Api\Features\Share\Mappers\CaptchaMapper;

class CaptchaModel
{
    use CaptchaMapper;

    public function __construct(
        public string $ssid,
        public string $picture,
    )
    {
    }
}