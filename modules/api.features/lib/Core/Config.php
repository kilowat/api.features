<?php

class AppConf {
    /**
     * @param string $index
     * @return mixed
     */
    public static function get($index) {
        global $config;
        include $_SERVER['DOCUMENT_ROOT'].'/local/modules/api.features/lib/config.php';
        $index = explode('.', $index);
        return self::getValue($index, $config);
    }
    /**
     * @param array $index
     * @param array $value
     * @return mixed
     */
    private static function getValue($index, $value) {
        if(is_array($index) and
            count($index)) {
            $current_index = array_shift($index);
        }
        if(is_array($index) and
            count($index) and
            is_array($value[$current_index]) and
            count($value[$current_index])) {
            return self::getValue($index, $value[$current_index]);
        } else {
            return $value[$current_index];
        }
    }
}