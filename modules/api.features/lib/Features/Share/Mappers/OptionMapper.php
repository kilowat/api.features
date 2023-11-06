<?php

namespace Api\Features\Share\Mappers;

use Api\Features\Share\Http\OptionResponse;
use Api\Features\Share\Models\HiloadValueModel;

trait OptionMapper
{
    public function toResponse(): OptionResponse
    {
        return new OptionResponse(
            id: $this->id,
            value: $this->value
        );
    }

    public static function fromHiloadValue(HiloadValueModel $model): OptionResponse
    {
        return new OptionResponse(
            id: $model->id,
            value: $model->name,
        );
    }
}