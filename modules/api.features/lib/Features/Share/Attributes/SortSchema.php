<?php
namespace Api\Features\Share\Attributes;

use Api\Features\Share\Http\SortParamResponse;
use Api\Features\Share\Models\SortParamModel;
use Api\Features\Share\Models\SortModel;

#[\Attribute]
class SortSchema
{
    public array $items;
    public SortParamModel $default;

    /**
     * @param SortModel[] $items
     * @param SortParamModel $default
     */
    public function __construct(
        array $items,
        SortParamModel $default
    )
    {
        $this->items = $items;
        $this->default = $default;
    }

    public static function empty(): SortSchema
    {
        return new SortSchema(items: [], default: SortParamModel::empty());
    }

    public static function fromAttribute(string $className): static
    {
        try{
            $class = new \ReflectionClass($className);
            $sort = $class->getAttributes();
            if($sort[0] !== null) {
                return $sort[0]->newInstance();
            }
        } catch (\Exception $e){
            return new SortSchema(
                items:[],
                default: new SortParamModel(by: '', direction:'')
            );
        }
        return new SortSchema(
            items:[],
            default: new SortParamModel(by: '', direction:'')
        );
    }
    /**
     * Конвертация сортировки с реального поля на код
     * @param SortParamModel $param
     * @return SortParamResponse
     */
    public function toParamResponse(SortParamModel $param): SortParamResponse
    {
        foreach ($this->items as $item) {
            if($item->field == $param->by) {
                return (new SortParamModel(
                    $item->code,
                    $param->direction)
                )->toResponse();
            }
        }

        return $this->default->toResponse();
    }

    public function toParamModel(SortParamModel $param): SortParamModel
    {
        foreach ($this->items as $item) {
            if($item->code == $param->by &&
                (mb_strtoupper($param->direction) == 'ASC' || mb_strtoupper($param->direction) == 'DESC')) {
                return new SortParamModel($item->field, $param->direction);
            }
        }
        return $this->default;
    }
}