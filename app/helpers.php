<?php

if (! function_exists('boolOrNull')) {
    function boolOrNull($var)
    {
        return isset($var) ? (bool)$var : null;
    }
}

if (! function_exists('asNumber')) {
    function asNumber($var)
    {
        return $var * 1;
    }
}
