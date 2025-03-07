<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('get_root_url')) {
    function get_root_url() {
        $CI =& get_instance();
        return str_replace('/testing/', '/', $CI->config->base_url());
    }
}

if (!function_exists('banner_url')) {
    function banner_url($image_name) {
        return get_root_url() . 'ImageTerasJapan/banner/' . $image_name;
    }
}

if (!function_exists('icon_url')) {
    function icon_url($image_name) {
        return get_root_url() . 'ImageTerasJapan/icon/' . $image_name;
    }
}

if (!function_exists('promo_url')) {
    function promo_url($image_name) {
        return get_root_url() . 'ImageTerasJapan/promo/' . $image_name;
    }
}

if (!function_exists('news_url')) {
    function news_url($image_name) {
        return get_root_url() . 'ImageTerasJapan/news_event/' . $image_name;
    }
}

if (!function_exists('reward_url')) {
    function reward_url($image_name) {
        return get_root_url() . 'ImageTerasJapan/reward/' . $image_name;
    }
}

if (!function_exists('brand_url')) {
    function brand_url($image_name) {
        return get_root_url() . 'ImageTerasJapan/logo/' . $image_name;
    }
}