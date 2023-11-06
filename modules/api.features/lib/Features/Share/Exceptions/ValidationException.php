<?php
namespace Api\Features\Share\Exceptions;

use Exception;

class ValidationException extends ApiException
{
    public function __construct($message = '', int|string $name = 'validation', $data = [], $code = 0, Exception $previous = null)
    {
        $message = !empty($message) ? $message :  __('ERROR_VALIDATION_FIELD');
        parent::__construct($message, $name, $data, $code, $previous);
    }
}