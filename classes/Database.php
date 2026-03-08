<?php
    require_once dirname(__DIR__) . "/config/config.php";

    class Database {
        private $host = DB_HOST;
        private $db_user = DB_USER;
        private $db_name = DB_NAME;
        private $db_password = DB_PASS;
        public $conn;

        public function getConnection() {
            $this->conn = null;

            try {
                $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->db_user, $this->db_password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }

            return $this->conn;
        }
    }
?>