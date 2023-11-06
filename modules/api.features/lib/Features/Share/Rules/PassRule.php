<?php

namespace Api\Features\Share\Rules;
namespace Api\Features\Share\Rules;

use Attribute;
use Yiisoft\Validator\RuleHandlerInterface;
use Yiisoft\Validator\RuleInterface;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class PassRule implements RuleInterface
{
    public function __construct(
        public readonly bool $required = true,
        public readonly int $minLen = 6,
        public readonly string $minLenMessage = 'Пароль должен быть минимум {minLen}',
    )
    {
    }

    public function getName(): string
    {
        return 'emailExists';
    }

    public function getHandler(): string|RuleHandlerInterface
    {
        return PassHandler::class;
    }

    public function getMinLenMessage(): string
    {
        return $this->minLenMessage;
    }
}