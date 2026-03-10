<?php
    require_once "init.php";
    include base_path("partials/admin/header.php");
    include base_path("partials/admin/nav.php");

    if(!$_SESSION['logged_in']) {
        redirect('index.php');
    }

    $article = new Article();
    $articles = $article->getAllWithAutors(intval($_SESSION['user_id']));

    var_dump($articles)
?>
 
    <!-- Main Content -->
    <main class="container my-5">
        <h2 class="mb-4">Admin Dashboard</h2>

        <!-- Articles Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Published Date</th>
                        <th>Excerpt</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($articles as $articleItem): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($articleItem->id); ?></td>
                            <td><?php echo htmlspecialchars($articleItem->title); ?></td>
                            <td><?php echo htmlspecialchars($articleItem->title); ?></td>
                            <td><?php echo htmlspecialchars(transform_date($articleItem->created_at)); ?></td>
                            <td>
                                <?php echo htmlspecialchars($articleItem->content); ?>
                            </td>
                            <td>
                                <a href="edit-article.php?id=<?php echo htmlspecialchars($articleItem->id); ?>" class="btn btn-sm btn-primary me-1">Edit</a>
                                <button class="btn btn-sm btn-danger" onclick="confirmDelete(2)">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <!-- You can add more articles here -->
                </tbody>
            </table>
        </div>
    </main>

<?php 
    include "partials/admin/footer.php";
?>