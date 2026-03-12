<!-- Navigation Bar -->
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">CMS PDO System</a>
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
                    <?php if(isset($_SESSION['logged_in'])): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo link_checker('index.php') ? 'active' : '' ?>" aria-current="<?php echo link_checker('index.php') ? 'page' : '' ?>" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo link_checker('admin.php') ? 'active' : '' ?>" aria-current="<?php echo link_checker('admin.php') ? 'page' : '' ?>" href="admin.php">Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo link_checker('about.php') ? 'active' : '' ?>" aria-current="<?php echo link_checker('about.php') ? 'page' : '' ?>" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo link_checker('contact.php') ? 'active' : '' ?>" aria-current="<?php echo link_checker('contact.php') ? 'page' : '' ?>" href="contact.php">Contact</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo link_checker('index.php') ? 'active' : '' ?>" aria-current="<?php echo link_checker('index.php') ? 'page' : '' ?>" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo link_checker('about.php') ? 'active' : '' ?>" aria-current="<?php echo link_checker('about.php') ? 'page' : '' ?>" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo link_checker('contact.php') ? 'active' : '' ?>" aria-current="<?php echo link_checker('contact.php') ? 'page' : '' ?>" href="contact.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo link_checker('login.php') ? 'active' : '' ?>" aria-current="<?php echo link_checker('login.php') ? 'page' : '' ?>" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo link_checker('register.php') ? 'active' : '' ?>" aria-current="<?php echo link_checker('register.php') ? 'page' : '' ?>" href="register.php">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>