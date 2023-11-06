<?php

namespace Api\Features\Share\Rules;
namespace Api\Features\Share\Rules;

use Attribute;
use Yiisoft\Validator\RuleHandlerInterface;
use Yiisoft\Validator\RuleInterface;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class CaptchaRule implements RuleInterface
{
    public function __construct(
        public readonly string $wrongCaptcha = 'Неверное проверочное слово',
    )
    {
    }

    public function getName(): string
    {
        return 'captcha';
    }

    public function getHandler(): string|RuleHandlerInterface
    {
        return CaptchaHandler::class;
    }

    public function getWrongCaptchaMessage(): string
    {
        return $this->wrongCaptcha;
    }
}