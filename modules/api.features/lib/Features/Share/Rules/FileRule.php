<?php

namespace Api\Features\Share\Rules;

use Attribute;
use Yiisoft\Validator\RuleHandlerInterface;
use Yiisoft\Validator\RuleInterface;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
class FileRule implements RuleInterface
{
    public function __construct(
        public readonly bool $required = false,
        public readonly int $maxSizeMb = 20,
        public readonly array $allowTypes = [
            'jpg',
            'jpeg',
            'png',
        ],
        public readonly string $incorrectFileSizeMessage = 'Неверный размер файла {name}, файл должен быть меньше {maxSize} мб. текущий размер {currentSize} мб.',
        public readonly string $incorrectFileTypeMessage = 'Неверный формат {currentType} файла {name}, файл должен быть {fileType}',
    )
    {
    }

    public function getName(): string
    {
        return 'file';
    }

    public function getHandler(): string|RuleHandlerInterface
    {
        return FileHandler::class;
    }

    public function getIncorrectFileSizeMessage()
    {
        return $this->incorrectFileSizeMessage;
    }
    public function getIncorrectFileTypeMessage()
    {
        return $this->incorrectFileTypeMessage;
    }
}