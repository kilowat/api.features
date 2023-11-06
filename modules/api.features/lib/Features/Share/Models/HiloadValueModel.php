<?php

namespace Api\Features\Share\Models;

use Api\Features\Share\Mappers\HiloadValueMapper;

class HiloadValueModel
{
    use HiloadValueMapper;

    public function __construct(
        public int | string $id,
        public string $code = '',
        public string $name = '',
        public string $description = '',
    )
    {
    }
}