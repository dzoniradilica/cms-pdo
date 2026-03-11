<?php
    require_once "init.php";
    include base_path("partials/admin/header.php");
    include base_path("partials/admin/nav.php");

    if(!$_SESSION['logged_in']) {
        redirect('index.php');
    }

    if(isset($_GET['id'])) {
        $article = new Article();
        $single_article = $article->getWithAuthor(intval($_GET['id']), intval($_SESSION['user_id']));
        $image_name = $single_article->image;
        
        if(isPostRequest()) {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $date = $_POST['date'];

            if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $upload_dir = 'uploads/';
                $img_name = $_FILES['image']['name'];
                $img_tmp = $_FILES['image']['tmp_name'];
                $img_type = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));

                // Generiranje unikatnog imena
                $unique_name = strstr($img_name, '.', true) . "_" . uniqid() . "." . $img_type;
                $target_file = $upload_dir . $unique_name;

                if(move_uploaded_file($img_tmp, $target_file)) {
                    // AKO JE UPLOAD USPJEO:
                    // 1. Obriši staru sliku s diska (ako je postojala)
                    if(!empty($single_article->image) && file_exists($upload_dir . $single_article->image)) {
                        unlink($upload_dir . $single_article->image);
                    }
                    // 2. Postavi novo ime za bazu
                    $image_name = $unique_name;
                }
            }

            if($article->update($title, $content, $image_name, $date)) {
                redirect('admin.php');
            }
        }
    }
?>

    <!-- Main Content -->
    <main class="container my-5">
        <h2>Edit Article</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Article Title *</label>
                <input type="text" class="form-control" id="title" value="<?php echo htmlspecialchars($single_article->title); ?>" required>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" id="author" value="<?php echo htmlspecialchars($single_article->username); ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Published Date *</label>
                <input type="date" class="form-control" id="date" value="<?php echo htmlspecialchars(transform_date($single_article->created_at)); ?>" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content *</label>
                <textarea class="form-control" id="content" rows="10" required><?php echo htmlspecialchars($single_article->content); ?></textarea>
            </div>
            <div class="mb-3" 
                style="
                display: flex;
                flex-direction: column;
                margin-bottom: 50px !important;">
                <label for="image" class="form-label">Featured Image URL</label>
                <img 
                src="<?php echo $single_article->image ? 'uploads/' . htmlspecialchars($single_article->image) : 'https://placehold.co/600x400' ?>"
                style="width: 300px; height: 200px; margin-bottom: 20px;">
                <input type="file" name="image" class="form-control" id="image" placeholder="Enter image URL">
            </div>
            <button type="submit" class="btn btn-primary">Update Article</button>
            <a href="admin.php" class="btn btn-secondary ms-2">Cancel</a>
        </form>
    </main>

<?php 
    include base_path("partials/admin/footer.php");
?>
