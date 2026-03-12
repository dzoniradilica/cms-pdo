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

    function transform_content($str) {
        if(strlen($str) > 100) {
            return substr($str, 0, 99) . "...";
        }

        return $str;
    }

    function upload_image($article, $title, $content, $user_id, $date, $image, $img_err) {
        if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = 'uploads/';
            $img_name = $_FILES['image']['name'];
            $img_tmp = $_FILES['image']['tmp_name'];
            $img_size = $_FILES['image']['size'];
            $img_type = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
            $allowed_types = ['jpg', 'png', 'gif'];

            if($img_size > 4 * 1024 * 1024) {
                $img_err = "Image is to big!";
            } elseif(!in_array($img_type, $allowed_types)) {
                $img_err = 'Your image type is not allowed!';
            }

            if(empty($img_err)) {
                $clean_name = strstr($img_name, '.', true);
                $image = $clean_name . "_" . uniqid() . "." . $img_type;
                $target_file = $upload_dir . $image;

                if(move_uploaded_file($img_tmp, $target_file)) {
                    $article->create($title, $content, $user_id, $date, $image);
                    redirect('admin.php');
                } else {
                    echo "Something went wrong";
                }
            } else {
                $article->create($title, $content, $user_id, $date);
                redirect('admin.php');
            }
        } else {
            $article->create($title, $content, $user_id, $date);
            redirect('admin.php');
        }
    }

    function link_checker($path) {
        if(basename($_SERVER['PHP_SELF']) === $path) {
            return true;
        }

        return false;
    }
?>