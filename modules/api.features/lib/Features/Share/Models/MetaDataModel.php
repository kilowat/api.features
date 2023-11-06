<?php

namespace Api\Features\Share\Models;

use Api\Features\Share\Mappers\MetaDataMapper;


class MetaDataModel
{
    use MetaDataMapper;

    public function __construct(
        public string $title,
        public string $description,
    ){}

    public static function empty(): static
    {
        return new static(title: '', description: '');
    }
}