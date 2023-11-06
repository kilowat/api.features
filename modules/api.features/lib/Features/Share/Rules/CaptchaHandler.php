<?php

namespace Api\Features\Share\Rules;

use Api\Core\AppContext;
use Api\Features\Share\Http\CaptchaRequest;
use Attribute;
use Yiisoft\Validator\Exception\UnexpectedRuleException;
use Yiisoft\Validator\Result;
use Yiisoft\Validator\RuleHandlerInterface;
use Yiisoft\Validator\ValidationContext;
#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class CaptchaHandler implements RuleHandlerInterface
{
    public function validate(mixed $value, object $rule, ValidationContext $context): Result
    {
        if (!$rule instanceof CaptchaRule) {
            throw new UnexpectedRuleException(CaptchaRule::class, $rule);
        }
        /**
         * @var CaptchaRequest $value
         */
        $isCheck = AppContext::getInstance()->getCaptcha()->CheckCode($value->word, $value->ssid);

        if(!$isCheck) {
            return (new Result())->addError($rule->getWrongCaptchaMessage(), [
                'attribute' => $context->getTranslatedAttribute(),
            ], ['captcha']);
        }
        return new Result();
    }
}