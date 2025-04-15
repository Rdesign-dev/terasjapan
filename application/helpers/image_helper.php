<?php
if (!function_exists('image_url')) {
    function image_url($folder, $filename = '') {
        // Base URL for images
        $base_url = 'https://terasjapan.com/ImageTerasJapan/';
        
        // If no filename is provided, return the folder URL
        if (empty($filename)) {
            return rtrim($base_url . $folder, '/');
        }
        
        // Return complete URL
        return $base_url . trim($folder, '/') . '/' . $filename;
    }
}

if (!function_exists('reward_url')) {
    function reward_url($filename = '') {
        // Base URL for reward images
        $base_url = 'https://terasjapan.com/ImageTerasJapan/reward/';
        
        // Return complete URL
        return $base_url . $filename;
    }
}