<?php

function getFileName(string $file_url)
{
    $split_string = explode('/', $file_url);

    return $split_string[(count($split_string) - 1)];
}
