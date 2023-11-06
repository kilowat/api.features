<?php

namespace Api\Features\Share\Exceptions;

use Exception;

class ApiException extends Exception
{
    public array $data;
    public string|int $name;

    public function __construct($message = '', string|int $name = 0, $data = [], $code = 0, Exception $previous = null) {
        $this->data = $data;
        $this->name = $name;
        parent::__construct($message, $code, $previous);
    }
}