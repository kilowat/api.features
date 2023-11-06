<?php

namespace Api\Features\Share\Mappers;

use Api\Features\Share\Http\PropItemResponse;

trait PropItemMapper
{
    public function toResponse(): PropItemResponse
    {
        return new PropItemResponse(
            description: $this->description,
            value: $this->value
        );
    }
}