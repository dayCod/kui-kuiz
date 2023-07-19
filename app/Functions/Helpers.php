<?php

/*
|--------------------------------------------------------------------------
| Get File Name From Formatted Image URL
|--------------------------------------------------------------------------
*/
if (!function_exists('getFileName')) {

    function getFileName(string $file_url)
    {
        $split_string = explode('/', $file_url);

        return $split_string[(count($split_string) - 1)];
    }

}
