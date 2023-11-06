<?php

namespace Api\Features\Share\Mappers;

use Api\Features\Share\Http\HiloadValueResponse;
use Api\Features\Share\Models\HiloadValueModel;

trait HiloadValueMapper
{
    public function toModel(): HiloadValueModel
    {
        return new HiloadValueModel(
            id: $this->id,
            code: $this->code,
            name: $this->name,
            description: $this->description ?? '',
        );
    }

    public function toResponse(): HiloadValueResponse
    {
        return new HiloadValueResponse(
            id: (string)$this->id,
            code: $this->code,
            name: $this->name,
            description: $this->description,
        );
    }

    public static function fromHiArrValues(array $values): array
    {
        return array_map(function ($item) {
            return self::fromHiValue($item->getHighload());
        }, $values);
    }

    public static function fromHiValue($value): HiloadValueModel
    {
        return new HiloadValueModel(
            id: $value->getId(),
            code: $value->getUfXmlId(),
            name: $value->getUfName(),
            description: $value->getUfDescription() ?? '',
        );
    }
}