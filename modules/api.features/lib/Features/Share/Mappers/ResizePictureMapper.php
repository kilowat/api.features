<?php

namespace Api\Features\Share\Mappers;

use Api\Features\Share\Http\ResizePictureResponse;

trait ResizePictureMapper
{
    public function toResponse(): ResizePictureResponse
    {
        return new ResizePictureResponse(
            sm: $this->sm?->toResponse(),
            md: $this->md?->toResponse(),
            orig: $this->orig?->toResponse(),
        );
    }
}