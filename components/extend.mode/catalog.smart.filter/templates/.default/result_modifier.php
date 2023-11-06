<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$result = [];

$arDisplayTypes = [
    'A'=>'number-range', // Число от-до, с ползунком
    'B'=>'number', // Число от-до
    'F'=>'checkbox', // Флажки
    'G'=>'checkbox', // Флажки с картинками
    'H'=>'checkbox', // Флажки с названиями и картинками
    'K'=>'radio', // Радиокнопки
    'P'=>'dropdown', // Выпадающий список
    'R'=>'dropdown', // Выпадающий список с названиями и картинками
];

$FILED_VIEWS = [
    'DROPDOWN'=>['TSVET_TOVARA','CATEGORY_LIST','RAZMER','FAKTURA']
];

foreach ($arResult['ITEMS'] as $arItem)
{
    $values = [];

    if($arItem['CODE'] == 'BASE') break;

    foreach ($arItem['VALUES'] as $VALUE)
    {

        $nameNormalize = explode('/',$VALUE['VALUE']);
        foreach ($nameNormalize as &$title)
        {
            $title=  ucfirst($title);
        }
        $nameNormalize = implode('/',$nameNormalize);

        $values[] = [
            'input_name'=>$VALUE['CONTROL_NAME'],
            'input_value'=>$VALUE['HTML_VALUE'],
            'name'=>$VALUE['VALUE'],
            'name_normalize'=>$nameNormalize,
            'elements_count'=>$VALUE['ELEMENT_COUNT'],
            "isChecked"=> $VALUE['CHECKED'] == true,
            "isDisabled"=> $VALUE['DISABLED'] == true,
            "sort"=> $VALUE['SORT'],
            "picture"=>  is_array($VALUE['FILE']) && !empty($VALUE['FILE']['SRC']) ? 'https://awww.moscow'.$VALUE['FILE']['SRC'] : '',
        ];
    }

    usort($values, function($a, $b) {
        return $a['isDisabled'] <=> $b['isDisabled'];
    });



    $itemView = $arDisplayTypes[$arItem['DISPLAY_TYPE']] ? $arDisplayTypes[$arItem['DISPLAY_TYPE']] : $arItem['DISPLAY_TYPE'];
    $itemView = in_array($arItem['CODE'], $FILED_VIEWS['DROPDOWN']) ? 'dropdown' : $itemView;

    if(is_array($values) && !empty($values))
    {
        $result['items'][] = [
            'id'=>$arItem['ID'],
            'code'=>$arItem['CODE'],
            'name'=>$arItem['NAME'],
            'hint'=>$arItem['FILTER_HINT'],
            'query'=>'',
            'type'=>$itemView,
            'values'=>$values,
        ];
    }


}

// showArray($arResult);
// f_810_3173458478

$arResult['JSON'] = $result;


