<?php
    require_once dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . "init.php";

    if(isPostRequest()) {
        $user = new User();

        $user->logout();
    }
?>

<!-- Navigation Bar -->
     <?php if(isset($_SESSION['logged_in'])): ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">CMS PDO System - Admin</a>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div
                    class="collapse navbar-collapse"
                    id="navbarNav"
                >
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="admin.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="create-article.php">Create Article</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">View Site</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="profile.php">Profile</a>
                        </li>
                        <form action="" method="post" type="submit">
                            <button style="border: 0; background: 0; padding: 0; ">
                                <li class="nav-item">
                                    <a class="nav-link" style="cursor: pointer;">Logout</a>
                                </li>
                            </button>
                        </form>
                    </ul>
                </div>
            </div>
        </nav>
    <?php endif; ?>
