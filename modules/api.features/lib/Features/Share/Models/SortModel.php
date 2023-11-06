<?php

namespace Api\Features\Share\Models;

use Api\Features\Share\Mappers\SortMapper;

class SortModel
{
    use SortMapper;

    public string $code;
    public string $name;
    public string $field;

    public function __construct(
        string $code,
        string $name,
        string $field)
    {
        $this->code = $code;
        $this->name = $name;
        $this->field = $field;
    }

    public static function empty(): static
    {
        return new static(code: '', name: '', field: '');
    }
}