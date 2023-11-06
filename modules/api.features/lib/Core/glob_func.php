<?php
use Bitrix\Main\Localization\Loc;

function getDomain(): ?string
{
    return _conf('domain');
}

function _conf(string $index): string
{
    AppConf::get($index);
}

function __($code, $rpl = [], $lang = null): string
{
    if($lang == null) {
        $lang = 'ru';
    }

    $lang_text_arr = require (__DIR__.'../../Lang/'.$lang.'.php');
    $text = $lang_text_arr[$code];
    foreach ($rpl as $rKey => $rValue) {
        $text = str_replace('#'.$rKey.'#', $rValue, $text);
    }

    return $text;
}
function num_words( $number, $titles, $show_number = true )
{

    if( is_string( $titles ) ){
        $titles = preg_split( '/, */', $titles );
    }

    // когда указано 2 элемента
    if( empty( $titles[2] ) ){
        $titles[2] = $titles[1];
    }

    $cases = [ 2, 0, 1, 1, 1, 2 ];

    $intnum = abs( (int) strip_tags( $number ) );

    $title_index = ( $intnum % 100 > 4 && $intnum % 100 < 20 )
        ? 2
        : $cases[ min( $intnum % 10, 5 ) ];

    return ( $show_number ? "$number " : '' ) . $titles[ $title_index ];
}

function filesize_convertor($bytes, $decimals = 2){
    $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}

function dateAgo(int $time): string
{
    return FormatDate('dago'                   // выведет "9 июля 2012", если год прошел
    , $time);
}

function dd($var)
{
    var_dump($var); die();
}