<?php

namespace Api\Features\Share\Rules;
namespace Api\Features\Share\Rules;

use Attribute;
use Yiisoft\Validator\RuleHandlerInterface;
use Yiisoft\Validator\RuleInterface;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class EmailExistsRule implements RuleInterface
{
    public function __construct(
        public readonly string $emailNotFoundMessage = 'Такой email не зарегистрирован',
    )
    {
    }

    public function getName(): string
    {
        return 'emailExists';
    }

    public function getHandler(): string|RuleHandlerInterface
    {
        return EmailExistsHandler::class;
    }

    public function getEmailNotFoundMessage(): string
    {
        return $this->emailNotFoundMessage;
    }
}