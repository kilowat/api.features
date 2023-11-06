<?php

namespace Api\Features\Share\Models;

use Api\Features\Share\Mappers\PropItemMapper;

class PropItemModel
{
    use PropItemMapper;

    public function __construct(
        public string $description = '',
        public string $value = '',
    )
    {}
}