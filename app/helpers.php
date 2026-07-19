<?php

if (!function_exists('validate')) {
    function validate($data) {
        return filter_var($data, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    }
}
