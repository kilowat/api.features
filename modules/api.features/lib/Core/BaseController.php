<?php
namespace Api\Core;

use Api\Features\Share\Exceptions\ValidationException;
use Api\MapExceptions;
use Bitrix\Main\Engine\Controller;
use ReflectionException;
use Yiisoft\Translator\CategorySource;
use Yiisoft\Translator\SimpleMessageFormatter;
use Yiisoft\Translator\Translator;
use Yiisoft\Validator\ValidationContext;
use Yiisoft\Validator\Validator;
use Yiisoft\Translator\Message\Php\MessageSource;

class BaseController extends Controller implements MapExceptionable
{
    use MapExceptions;

    public function getAutoWiredParameters(): array
    {
         return require ($_SERVER['DOCUMENT_ROOT'].'/local/modules/api.features/lib/di.php');
    }

    /**
     * Returns default pre-filters for action.
     * @return array
     */
    protected function getDefaultPreFilters(): array
    {
        return array();
    }

    /**
     * @throws ReflectionException
     * @throws ValidationException
     */
    public function validateRequest(
        mixed $data,
        callable|iterable|object|string|null $rules = null,
        ?ValidationContext $context = null,
    ): void
    {
        $translationsPath = $_SERVER['DOCUMENT_ROOT'].'/local/api/vendor/yiisoft/validator/messages';
        $categorySource = new CategorySource(
            Validator::DEFAULT_TRANSLATION_CATEGORY,
            new MessageSource($translationsPath),
            new SimpleMessageFormatter(),
        );
        $translator = new Translator(locale: 'ru');
        $translator->addCategorySources($categorySource);

        $validation = (new Validator(translator: $translator))->validate($data, $rules, $context);
        if(!$validation->isValid()) {
            throw new ValidationException(data: $validation->getErrorMessagesIndexedByAttribute());
        }
    }
}