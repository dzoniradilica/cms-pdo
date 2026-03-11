<?php
    require_once "init.php";
    include base_path("partials/admin/header.php");
    include base_path("partials/admin/nav.php");

    if(!$_SESSION['logged_in']) {
        redirect('index.php');
    }

    if(isPostRequest()) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $user_id = $_SESSION['user_id'];
        $date = $_POST['date'];
        $image = null;
        $img_err = '';

        $article = new Article();

        upload_image($article, $title, $content, $user_id, $date, $image, $img_err);

        // if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        //     $upload_dir = 'uploads/';
        //     $img_name = $_FILES['image']['name'];
        //     $img_tmp = $_FILES['image']['tmp_name'];
        //     $img_size = $_FILES['image']['size'];
        //     $img_type = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));
        //     $allowed_types = ['jpg', 'png', 'gif'];

        //     if($img_size > 4 * 1024 * 1024) {
        //         $img_err = "Image is to big!";
        //     } elseif(!in_array($img_type, $allowed_types)) {
        //         $img_err = 'Your image type is not allowed!';
        //     }

        //     if(empty($img_err)) {
        //         $clean_name = strstr($img_name, '.', true);
        //         $image = $clean_name . "_" . uniqid() . "." . $img_type;
        //         $target_file = $upload_dir . $image;

        //         if(move_uploaded_file($img_tmp, $target_file)) {
        //             $article->create($title, $content, $user_id, $date, $image);
        //             redirect('admin.php');
        //         } else {
        //             echo "Something went wrong";
        //         }
        //     } else {
        //         $article->create($title, $content, $user_id, $date);
        //         redirect('admin.php');
        //     }
        // } else {
        //     $article->create($title, $content, $user_id, $date);
        //     redirect('admin.php');
        // }
    }
?>

    <!-- Main Content -->
    <main class="container my-5">
        <h2>Create New Article</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Article Title *</label>
                <input type="text" name="title" class="form-control" id="title" placeholder="Enter article title" required>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Published Date *</label>
                <input type="date" name="date" class="form-control" id="date" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content *</label>
                <textarea class="form-control" name="content" id="content" rows="10" placeholder="Enter article content" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Select Featured Image</label>
                <input type="file" name="image" class="form-control" id="image" placeholder="Enter image URL">
            </div>
            <button type="submit" class="btn btn-success">Publish Article</button>
            <a href="admin.php" class="btn btn-secondary ms-2">Cancel</a>
        </form>
    </main>

<?php 
    include base_path("partials/admin/footer.php");
?>
