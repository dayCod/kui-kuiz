<?php

/*
|--------------------------------------------------------------------------
| Get File Name From Formatted Image URL
|--------------------------------------------------------------------------
*/

use Carbon\Carbon;

if (!function_exists('getFileName')) {

    function getFileName(string $file_url)
    {
        $split_string = explode('/', $file_url);

        return $split_string[(count($split_string) - 1)];
    }
}

/*
|--------------------------------------------------------------------------
| Get all values from specific key in a multidimensional array
|--------------------------------------------------------------------------
*/
if (!function_exists('array_value_recursive')) {

    function array_value_recursive(mixed $key, array $arr){

        if ($key == "") throw new InvalidArgumentException("key cannot null or be an empty string ``");

        $val = array();
        array_walk_recursive($arr, function($v, $k) use($key, &$val){
            if($k == $key) array_push($val, $v);
        });
        return count($val) > 1 ? $val : array_pop($val);
    }

}

/*
|--------------------------------------------------------------------------
| Format Timestamp Based on Local Config Timezone
|--------------------------------------------------------------------------
*/
if (!function_exists('setTimestamp')) {

    function setTimestamp(string $date, bool $is_unix = false){
        $carbon = Carbon::parse($date)->setTimezone(config('app.timezone', 'Asia/Bangkok'));

        return ($is_unix) ? $carbon->timestamp : $carbon->format('Y-m-d H:i:s');
    }

}
