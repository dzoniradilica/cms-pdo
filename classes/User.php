<?php
    class User {
        private $conn;
        private $table = 'users';

        public function __construct()
        {
            $db = new Database();
            $this->conn = $db->getConnection();
        }

        public function create($username, $email, $password) {
            $query = "INSERT INTO " . $this->table . " (username, email, password) VALUES (:username, :email, :hashed_password)";
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':hashed_password', $hashed_password);

            if($stmt->execute()) {
                return true;
            }

            return false;
        }

        public function exists($username, $email) {
            $query = "SELECT id FROM " . $this->table . " WHERE username = :username OR email = :email";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([
                ':username' => $username,
                ':email' => $email
            ]);

            return $stmt->rowCount() > 0;
        }

        public function login($email, $password) {
            $query = "SELECT * FROM " . $this->table . " WHERE email = :email LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_OBJ);

            if($user && password_verify($password, $user->password)) {
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $user->id;
                $_SESSION['username'] = $user->username;
                $_SESSION['email'] = $user->email;
                return true;
            }

            return false;
        }
    }
?>