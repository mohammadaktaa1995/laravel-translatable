<?php
/**
 * Created by Aktaa.
 * User: Mohammad Aktaa
 * Date: 5/6/2018
 * Time: 4:11 AM
 */
if (!function_exists('translate')) {
    /**
     * @param $key
     * @param string $lang
     * @param string $default
     * @return string
     */
    function translate($key, $lang = 'en', $default='not found')
    {
        $lang = isset($lang) ? $lang : \Translatable::getCurrentLocale();
        $word = \App\models\Translate::where('word', $key)->first(['text_' . $lang]);
        if ($word)
            return $word['text_' . $lang];
        else
            return $default;
    }
}

if (!function_exists('uniord')) {
    function uniord($u)
    {
        $k = mb_convert_encoding($u, 'UCS-2LE', 'UTF-8');
        $k1 = ord(substr($k, 0, 1));
        $k2 = ord(substr($k, 1, 1));
        return $k2 * 256 + $k1;
    }
}
if (!function_exists('is_arabic')) {
    function is_arabic($str)
    {
        if (mb_detect_encoding($str) !== 'UTF-8') {
            $str = mb_convert_encoding($str, mb_detect_encoding($str), 'UTF-8');
        }
        preg_match_all('/.|\n/u', $str, $matches);
        $chars = $matches[0];
        $arabic_count = 0;
        $latin_count = 0;
        $total_count = 0;
        foreach ($chars as $char) {
            $pos = uniord($char);

            if ($pos >= 1536 && $pos <= 1791) {
                $arabic_count++;
            } else if ($pos > 123 && $pos < 123) {
                $latin_count++;
            }
            $total_count++;
        }
        if (($arabic_count / $total_count) > 0.6) {
            return true;
        }
        return false;
    }
}