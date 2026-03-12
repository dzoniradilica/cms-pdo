<?php
    include 'init.php';
    include base_path('partials/header.php');
    include base_path('partials/nav.php');

    $article = new Article();
    $user = new User();
    $single_article = $article->get(intval($_GET['id']));
    $single_user = $user->get($single_article->user_id);
?>

<!-- Article Header -->
    <header class="bg-dark text-white py-5">
        <div class="container">
            <h1 class="display-4"><?php echo htmlspecialchars($single_article->title); ?></h1>
            <!-- <p class="lead">
                A brief subtitle or summary of the article.
            </p> -->
            <p>
                <small>
                    By <a href="#" class="text-white text-decoration-underline"><?php echo htmlspecialchars($single_user->username); ?></a> <!-- Add Author Name Here -->
                    |
                    <span>Published on <?php echo transform_date(htmlspecialchars($single_article->created_at)); ?></span> <!-- Date Published -->
                </small>
            </p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container my-5">
        <!-- Featured Image -->
        <div class="mb-4">
            <img
                src="<?php echo $single_article->image ? 'uploads/' . htmlspecialchars($single_article->image) : "https://placehold.co/600x400"; ?>"
                class="img-fluid w-100"
                alt="Featured Image"
            >
        </div>
        <!-- Article Content -->
        <article>
            <p>
                <?php echo htmlspecialchars($single_article->content); ?>
            </p>
        </article>

        <!-- Comments Section Placeholder -->
        <section class="mt-5">
            <h3>Comments</h3>
            <p>
                <!-- Placeholder for comments -->
                Comments functionality will be implemented here.
            </p>
        </section>

        <!-- Back to Home Button -->
        <div class="mt-4">
            <a href="index.php" class="btn btn-secondary">← Back to Home</a>
        </div>
    </main>

<?php 
    include base_path('partials/footer.php');
?>
