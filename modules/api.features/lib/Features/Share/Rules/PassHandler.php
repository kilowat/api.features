<?php

namespace Api\Features\Share\Rules;
use Attribute;
use Bitrix\Main\UserTable;
use Yiisoft\Validator\Exception\UnexpectedRuleException;
use Yiisoft\Validator\Result;
use Yiisoft\Validator\RuleHandlerInterface;
use Yiisoft\Validator\ValidationContext;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class PassHandler implements RuleHandlerInterface
{
    public function validate(mixed $value, object $rule, ValidationContext $context): Result
    {
        if (!$rule instanceof EmailExistsRule) {
            throw new UnexpectedRuleException(EmailExistsRule::class, $rule);
        }
        $found = UserTable::getList(['filter' => ['email' => $value]])->fetchObject();

        if(!$found) {
            return (new Result())->addError($rule->getEmailNotFoundMessage(), [
                'attribute' => $context->getTranslatedAttribute(),
            ]);

        }
        return new Result();
    }
}