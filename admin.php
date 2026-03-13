<?php
    require_once "init.php";
    include base_path("partials/admin/header.php");
    include base_path("partials/admin/nav.php");

    if(!$_SESSION['logged_in']) {
        redirect('index.php');
    }

    $user = new User();
    $foundUser = $user->get(intval($_SESSION['user_id']));
    $article = new Article();
    $articles = $article->getAllWithAuthor(intval($_SESSION['user_id']));
?>
 
    <!-- Main Content -->
    <main class="container my-5">
        <h2 class="mb-4"><?php echo "{$foundUser->username} Welcome to Admin Dashboard" ?></h2>

        <form action="generate-articles.php" method="post" style="margin-bottom: 20px; display: flex; align-items: center; gap: 20px;">
            <label for="generate_articles">Number of Articlesa</label>
            <input type="number" min="1" name="generate_articles" required>
            <button type="submit" class="btn btn-sm btn-primary me-1 p-1.5">Generate Articles</button>
        </form>
        <!-- Articles Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th><input type="checkbox" name="checkboxAll"></th>
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
                            <td><input type="checkbox" name="" id=""></td>
                            <td><?php echo htmlspecialchars($articleItem->id); ?></td>
                            <td><?php echo htmlspecialchars($articleItem->title); ?></td>
                            <td><?php echo htmlspecialchars($articleItem->username); ?></td>
                            <td><?php echo htmlspecialchars(transform_date($articleItem->created_at)); ?></td>
                            <td>
                                <?php echo htmlspecialchars(transform_content($articleItem->content)); ?>
                            </td>
                            <td style="display: flex;">
                                <a href="edit-article.php?id=<?php echo htmlspecialchars($articleItem->id); ?>" class="btn btn-sm btn-primary me-1">Edit</a>
                                <form action="delete-article.php" method="post">
                                    <input type="hidden" name="article_id" value="<?php echo htmlspecialchars($articleItem->id); ?>" >
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
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