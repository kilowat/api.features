<?php

namespace Api\Features\Share\Mappers;

use Api\Features\Share\Http\CaptchaResponse;

trait CaptchaMapper
{
    public function toResponse(): CaptchaResponse
    {
        return new CaptchaResponse(
            ssid: $this->ssid,
            picture: $this->picture
        );
    }
}