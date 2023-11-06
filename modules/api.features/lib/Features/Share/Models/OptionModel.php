<?php

namespace Api\Features\Share\Models;

use Api\Features\Share\Mappers\OptionMapper;

class OptionModel
{
    use OptionMapper;

    public function __construct(
        public string $id,
        public string $value,
    )
    {
    }
}