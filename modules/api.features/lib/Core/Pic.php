<?
namespace Api\Core;

class Pic
{

    private static $isPng = true;


    public static function resizeById($id, $width, $height, $isProportional = false, $watterMark = false)
    {
        if ($id) {
            return self::getResizeWebp(\CFile::GetFileArray($id), $width, $height, $isProportional, 70, $watterMark);
        } else {
            return null;
        }
    }

    private static function checkFormat($str)
    {
        if ($str === 'image/png') {
            self::$isPng = true;

            return true;
        } elseif ($str === 'image/jpeg') {
            self::$isPng = false;

            return true;
        } else return false;
    }

    private static function implodeSrc($arr)
    {
        $arr[count($arr) - 1] = '';

        return implode('/', $arr);
    }

    private static function generateSrc($str)
    {
        $arPath = explode('/', $str);

        if ($arPath[2] === 'resize_cache') {
            $arPath = self::implodeSrc($arPath);

            return str_replace('resize_cache/iblock', 'webp/resize_cache', $arPath);
        } else {
            $arPath = self::implodeSrc($arPath);

            return str_replace('upload/iblock', 'upload/webp/iblock', $arPath);
        }
    }

    public static function getWebp($array, $intQuality = 90)
    {
        if (self::checkFormat($array['CONTENT_TYPE'])) {
            $array['WEBP_PATH'] = self::generateSrc($array['SRC']);

            if (self::$isPng) {
                $array['WEBP_FILE_NAME'] = str_replace('.png', '.webp', strtolower($array['FILE_NAME']));
            } else {
                $array['WEBP_FILE_NAME'] = str_replace('.jpg', '.webp', strtolower($array['FILE_NAME']));
                $array['WEBP_FILE_NAME'] = str_replace('.jpeg', '.webp', strtolower($array['WEBP_FILE_NAME']));
                $array['WEBP_FILE_NAME'] = str_replace('.JPG', '.webp', strtolower($array['WEBP_FILE_NAME']));
                $array['WEBP_FILE_NAME'] = str_replace('.JPEG', '.webp', strtolower($array['WEBP_FILE_NAME']));
            }

            if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $array['WEBP_PATH'])) {
                mkdir($_SERVER['DOCUMENT_ROOT'] . $array['WEBP_PATH'], 0777, true);
            }

            $array['WEBP_SRC'] = $array['WEBP_PATH'] . $array['WEBP_FILE_NAME'];

            if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $array['WEBP_SRC'])) {
                if (self::$isPng) {
                    $im = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'] . $array['SRC']);
                } else {
                    $im = imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT'] . $array['SRC']);
                }
                if(!$im) {
                    $im = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'] . $array['SRC']);
                }
                imagewebp($im, $_SERVER['DOCUMENT_ROOT'] . $array['WEBP_SRC'], $intQuality);

                imagedestroy($im);

                if (filesize($_SERVER['DOCUMENT_ROOT'] . $array['WEBP_SRC']) % 2 == 1) {
                    file_put_contents($_SERVER['DOCUMENT_ROOT'] . $array['WEBP_SRC'], "\0", FILE_APPEND);
                }
            }
        }

        return $array;
    }

    public static function resizePict($file, $width, $height, $isProportional = true, $intQuality = 70, $arFilters = false)
    {

        $file = \CFile::ResizeImageGet($file, array('width' => $width, 'height' => $height), ($isProportional ? BX_RESIZE_IMAGE_PROPORTIONAL_ALT : BX_RESIZE_IMAGE_EXACT), true, $arFilters, false, $intQuality);

        return $file;
    }

    public static function getResizeWebp($file, $width, $height, $isProportional = true, $intQuality = 70, $arFilters = false)
    {
        $resized = self::resizePict($file, $width, $height, $isProportional, $intQuality, $arFilters);

        $file['SRC'] = $resized['src'];

        $file['WIDTH'] = $resized['width'];
        $file['HEIGHT'] = $resized['height'];
        $file = self::getWebp($file, $intQuality);

        return [
            'ID' => $file['ID'],
            'HEIGHT' => $file['HEIGHT'],
            'WIDTH' => $file['WIDTH'],
            'CONTENT_TYPE' => $file['CONTENT_TYPE'],
            'FILE_NAME' => $file['FILE_NAME'],
            'ORIGINAL_NAME' => $file['ORIGINAL_NAME'],
            'DESCRIPTION' => $file['DESCRIPTION'],
            'SRC' => $file['WEBP_SRC'],
        ];
    }
}