<?php
if (!function_exists('banner_url')) {
    function banner_url($image_name) {
        // Get the root URL (up one level from the application URL)
        $root_url = dirname(base_url());
        return $root_url . '/ImageTerasJapan/banner/' . $image_name;
    }
}