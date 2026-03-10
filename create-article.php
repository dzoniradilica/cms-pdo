<?php
    require_once "init.php";
    include base_path("partials/admin/header.php");
    include base_path("partials/admin/nav.php");

    if(isPostRequest()) {
        $title = $_POST['title'];
        $content = $_POST['content'];
        $user_id = $_SESSION['user_id'];
        $date = $_POST['date'];

        $article = new Article();

        if(isset($_FILES['image'])) {
            if($_FILES['image']['error'] === 0) {
                $upload_dir = "uploads/";
                $file_name = basename($_FILES['image']['name']);
                $target_file = $upload_dir . $file_name;

                $file_size = $_FILES['image']['size'];
                $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

                $allowed_types = ['jpg', 'gif', 'png', 'jpeg'];

                if($file_size > 4 * 1024 * 1024) {
                    $fileErr = "Your file is too large: {$file_size}";
                    return;
                } elseif(!in_array($file_type, $allowed_types)) {
                    $fileErr = "Your file type is not allowed";
                    return;
                } else {
                    if(!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                        $fileErr = "Sorry, there was an error";
                    } else {
                        $image_id = uniqid();
                        $image_name = strstr($file_name, '.', true) . "/" . $image_id . "." . $file_type;
                        if($article->create($title, $content, intval($user_id), $date, $image_name)) {
                            redirect('admin.php');
                        } else {
                            echo "Something went wrong";
                        }
                    }
                }

            } else {
                    switch($_FILES['image']['error']) {
                        case UPLOAD_ERR_INI_SIZE: 
                            $fileErr = "The upload files exceeds the maximum size allowed by the server";
                    }
                }
        }

        if($article->create($title, $content, intval($user_id), $date)) {
            redirect('admin.php');
        } else {
            echo "Something went wrong";
        }
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
