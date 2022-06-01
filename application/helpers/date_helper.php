<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('bb_format_timestamp')) {
    function bb_format_timestamp($timestamp) {
        return date('d/m/Y H\hi', strtotime($timestamp));
    }
}