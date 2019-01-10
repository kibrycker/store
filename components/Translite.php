<?php
/**
 * Created by PhpStorm.
 * User: martyskinmaksim
 * Date: 29/12/18
 * Time: 15:10
 */

namespace components;


class Translite {

    public static function getTranslite($str) {
        $str = mb_strtolower($str);
        //$str = iconv('utf-8', 'windows-1251', );
        $str_ar = [' ', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ь', 'ы', 'ъ', 'э', 'ю', 'я', ',', '.', ':', '?', '!', '-', '"'];

        $transl_ar = ['_', 'a', 'b', 'v', 'g', 'd', 'e', 'yo', 'zh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'kh', 'ts', 'ch', 'sh', 'scsh', '', 'y', '', 'e', 'yu', 'ya', '', '', '', '', '', '_', ''];
        //var_dump($str_ar, $transl_ar);
        $translite = str_replace($str_ar, $transl_ar, $str);
        //var_dump($translite);die();
        return $translite;
    }

} 