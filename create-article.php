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
        <form action="" method="post">
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
                <label for="image" class="form-label">Featured Image URL</label>
                <input type="url" name="image" class="form-control" id="image" placeholder="Enter image URL">
            </div>
            <button type="submit" class="btn btn-success">Publish Article</button>
            <a href="admin.php" class="btn btn-secondary ms-2">Cancel</a>
        </form>
    </main>

<?php 
    include base_path("partials/admin/footer.php");
?>
