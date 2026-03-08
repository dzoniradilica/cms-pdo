<?php
    class User {
        private $conn;
        private $table = 'users';

        public function __construct($db)
        {
            $this->conn = $db;
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
    }
?>