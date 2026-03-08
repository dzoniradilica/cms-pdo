<?php
    class User {
        private $conn;
        private $table = 'users';

        public function __construct()
        {
            $db = new Database();
            $this->conn = $db->getConnection();
        }

        public function register($name, $email, $password) {

        }
    }
?>