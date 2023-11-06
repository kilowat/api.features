<?php

namespace Api\Features\Share\Models;
use Api\Features\Share\Mappers\SortParamMapper;

class SortParamModel
{
    use SortParamMapper;

    public function __construct(
        public string $by,
        public string $direction,
    )
    {
    }

    public static function empty(): static
    {
        return new static(by:'', direction: '');
    }

    public function toArraySort(): array
    {
        if(empty($this->by ) || empty($this->direction )) {
            return [];
        }
        return [$this->by => $this->direction];
    }
}