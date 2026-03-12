<?php
    require_once "init.php";

    if(!$_SESSION['logged_in']) {
        redirect('index.php');
    }

    if(isPostRequest() && isset($_POST['article_id'])) {
        $article = new Article();
        $single_article = $article->get(intval($_POST['article_id']));

        if(!empty($single_article->image) && file_exists($upload_dir . $single_article->image)) {
            unlink($upload_dir . $single_article->image);
        }
        
        if($article->delete(intval($_POST['article_id']))) {
            redirect('admin.php');
        } else {
            echo "Something went wrong!";
        }
    }
?>