<?php

function debug ($arr, $type = 0)
{
    if ($type) echo '<pre>' . print_r($arr, true) . '</pre>';
    else {
        echo '<pre>';
        var_dump($arr);
        echo '</pre>';
    }
}