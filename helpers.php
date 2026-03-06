<?php
    require_once 'init.php';

    function basic_url($path) {
        $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'];
        $baseUrl = $protocol . $host . '/' . PROJECT_ROOT;

        return $baseUrl . '/' . ltrim($path, '/');

        // $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== "off" ? 'https://' : 'http://';
        // $host = $_SERVER['HTTP_HOST'];
        // $baseUrl = $protocol . $host . '/' . PROJECT_DIR;
        // return $baseUrl . '/' . ltrim($path, '/');
    }
?>