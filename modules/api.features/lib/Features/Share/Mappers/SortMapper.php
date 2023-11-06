<?php

namespace Api\Features\Share\Mappers;

use Api\Features\Share\Http\SortParamResponse;
use Api\Features\Share\Http\SortResponse;
use Api\Features\Share\Models\SortParamModel;
use Api\Features\Share\Models\SortModel;

trait SortMapper
{
    public function toResponse(): SortResponse
    {
        return new SortResponse(
            code: $this->code,
            name: $this->name,
        );
    }
}