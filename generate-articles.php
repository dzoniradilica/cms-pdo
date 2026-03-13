<?php
    require_once "init.php";
    include 'random-articles.php';

    if(!$_SESSION['logged_in']) {
        redirect('admin.php');
    }

    if(isPostRequest() && isset($_POST['generate_articles'])) {
        $count = $_POST['generate_articles'];
        $article = new Article();
        $user_id = $_SESSION['user_id'];
        $date = date("Y/m/d");

        $successCount = 0;
        
        for($i = 0; $i < $count; $i++) {
            $randomItem = $random_articles[array_rand($random_articles)];

            if($article->create(
                $randomItem['title'],
                $randomItem['content'],
                intval($user_id),
                $date
            )) {
                $successCount++;
            }
        }

        if($successCount > 0) {
            redirect('admin.php');
        }
    }
?>