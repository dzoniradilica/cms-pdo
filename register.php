<?php
    require_once "init.php";
    require_once "partials/header.php";
    include base_path("partials/nav.php");

    $db = new Database();
    $conn = $db->getConnection();

    if(isPostRequest()) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if($password === $_POST['confirm-password']) {
            $user = new User($conn);

            if($user->create($username, $email, $password)) {
                redirect('admin.php');
            }
        } else {
            echo "Passwords don't match!";
        }
    }
?>

    <!-- Main Content -->
    <main class="container my-5">
        <h2 class="text-center mb-4">Register</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Full Name *</label>
                        <input
                            name="username"
                            type="text"
                            class="form-control"
                            id="name"
                            required
                        >
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address *</label>
                        <input
                            name="email"
                            type="email"
                            class="form-control"
                            id="email"
                            required
                        >
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password *</label>
                        <input
                            name="password"
                            type="password"
                            class="form-control"
                            id="password"
                            required
                        >
                    </div>
                    <div class="mb-3">
                        <label for="confirm-password" class="form-label">Confirm Password *</label>
                        <input
                            name="confirm-password"
                            type="password"
                            class="form-control"
                            id="confirm-password"
                            required
                        >
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
                <p class="mt-3 text-center">
                    Already have an account? <a href="login.php">Login here</a>.
                </p>
            </div>
        </div>
    </main>

<?php
    include base_path("partials/footer.php");
?>
