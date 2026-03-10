<?php
    require_once 'init.php';

    function basic_url($path = "") {
        $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'];
        $baseUrl = $protocol . $host . '/' . PROJECT_ROOT;

        return $baseUrl . '/' . ltrim($path, '/');
    }

    function base_path($path = "") {
        $rootPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . PROJECT_ROOT;

        return $rootPath . DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR);
    }

    function isPostRequest() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
           return true;
        }

        return false;
    }

    function redirect($location) {
        header("Location: $location");
        exit;
    }

    function transform_date($date) {
        return date_format(date_create($date), "Y/m/d");
    }
?>