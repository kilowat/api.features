<?php

namespace Api\Features\Share\Mappers;

use Api\Features\Share\Attributes\SortSchema;
use Api\Features\Share\Models\ListQueryModel;
use Api\Features\Share\Models\SortParamModel;

trait ListRequestMapper
{
    public function toModel(?SortSchema $schema = null): ListQueryModel
    {
        $sortParam =  new SortParamModel(by: $this->orderBy, direction: $this->orderDirection);
        return new ListQueryModel(
            sort: $schema ?  $schema->toParamModel($sortParam) : $sortParam,
            page: (int)$this->page,
            size: (int)$this->pageSize,
        );
    }
}