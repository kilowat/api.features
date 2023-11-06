<?php

namespace Api\Features\Share\Rules;

use Attribute;
use Bitrix\Main\Web\MimeType;
use Yiisoft\Validator\Exception\UnexpectedRuleException;
use Yiisoft\Validator\Result;
use Yiisoft\Validator\RuleHandlerInterface;
use Yiisoft\Validator\ValidationContext;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class FileHandler implements RuleHandlerInterface
{
    public function validate(mixed $value, object $rule, ValidationContext $context): Result
    {
        if (!$rule instanceof FileRule) {
            throw new UnexpectedRuleException(FileRule::class, $rule);
        }

        if($value['size'] == null && !$rule->required) return new Result();

        if( $this->byteToMb($value['size']) > $rule->maxSizeMb) {
            return (new Result())->addError($rule->getIncorrectFileSizeMessage(), [
                'attribute' => $context->getTranslatedAttribute(),
                'name' => $value['name'],
                'maxSize' => $rule->maxSizeMb,
                'currentSize' => $this->byteToMb($value['size']),
            ]);

        }
        $currentMime = $this->getMimType($value['type']);
        if( !in_array($currentMime, $rule->allowTypes)) {
            return (new Result())->addError($rule->getIncorrectFileTypeMessage(), [
                'attribute' => $context->getTranslatedAttribute(),
                'name' => $value['name'],
                'fileType' => implode(', ', $rule->allowTypes),
                'currentType' => $currentMime,
            ]);

        }

        return new Result();
    }

    private function getMimType($row)
    {
        $types = MimeType::getMimeTypeList();
        return array_search($row, $types);
    }

    private function byteToMb($value)
    {
        if($value == 0) return 0;
        return $value/1000/1000;
    }
}