<?php
namespace Api;

use Api\Features\Share\Exceptions\ApiException;
use Api\Features\Share\Exceptions\NotFoundException;
use Api\Features\Share\Exceptions\ValidationException;
use Bitrix\Main\Context;
use Bitrix\Main\Error;

trait MapExceptions
{
    public function mapExceptions(\Exception $e): void
    {
        $response = Context::getCurrent()->getResponse();
        switch ($e) {
            case is_a($e, NotFoundException::class) :
                $response->setStatus(404);
                $this->addError(new Error(__('ERROR_PAGE_NOT_FOUND'), 404));
                break;
            case is_a($e, ValidationException::class) :
                foreach ($e->data as $field => $fErrors) {
                    foreach ($fErrors as $message) {
                        $this->addError(new Error($message, $e->name, ['field' => $field]));
                    }
                }
                break;
            case is_subclass_of($e, ApiException::class) :
                $this->addError(new Error($e->getMessage(), $e->name, $e->data));
                break;
            default:
                $response->setStatus(500);
                $this->addError(new Error($e->getMessage(), 500, customData: [$e->getTrace()]));
        }
    }
}
