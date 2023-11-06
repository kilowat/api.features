<?php
use \Bitrix\Main\Engine\Response\Converter;
$converter = new Converter(Converter::OUTPUT_JSON_FORMAT);

$GLOBALS['smartFilterResult'] = $converter->process($arResult['JSON']);