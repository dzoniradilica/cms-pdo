<?php
    require_once "helpers.php";
    require_once 'init.php';
    require_once 'partials/header.php';
    include base_path("partials/nav.php");

    $article = new Article();
    $articles = $article->getAll();

    var_dump($articles);
?>  

    <!-- Header Section -->
    <header class="bg-dark text-white py-5">
        <div class="container">
            <h1 class="display-4">Welcome to the CMS PDO System</h1>
            <p class="lead">
                Sharing insights, ideas, and stories.
            </p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container my-5">
        <!-- Blog Post 1 -->
        <?php foreach($articles as $articleItem): ;?>
            <div class="row mb-4">
                <div class="col-md-4">
                    <img
                        src=<?php echo isset($articleItem->image) ? 'uploads/' . htmlspecialchars($articleItem->image) : "https://placehold.co/600x400"; ?>
                        class="img-fluid"
                        alt="Blog Post Image"
                    >
                </div>
                <div class="col-md-8">
                    <h2> <?php echo htmlspecialchars($articleItem->title); ?> </h2>
                    <p>
                        <?php echo transform_content(htmlspecialchars($articleItem->content)); ?>
                    </p>
                    <a href="article.php?id=<?php echo htmlspecialchars($articleItem->id); ?>" class="btn btn-primary">Read More</a>
                </div>
            </div>
        <?php endforeach; ?>    
    </main>

<?php 
    include "partials/footer.php";
?>