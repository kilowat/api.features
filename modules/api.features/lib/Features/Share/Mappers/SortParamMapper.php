<?php

namespace Api\Features\Share\Mappers;

use Api\Features\Share\Http\SortParamResponse;

trait SortParamMapper
{
    public function toResponse(): SortParamResponse
    {
        return new SortParamResponse(
            by: $this->by,
            direction: $this->direction
        );
    }
}