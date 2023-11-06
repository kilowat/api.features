<?php

namespace Api\Features\Share\Mappers;

use Api\Features\Share\Http\PaginationResponse;
use Api\Features\Share\Models\PaginationModel;

trait PaginationMapper
{
    public function toResponse(): PaginationResponse
    {
        return new PaginationResponse(
            total: $this->total,
            current: $this->current,
            count: $this->count,
            size: $this->size,
        );
    }
}