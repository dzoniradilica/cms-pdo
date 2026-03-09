<?php
    class Article {
        private $conn;
        private $table = 'articles';

        public function __construct()
        {
            $db = new Database();
            $this->conn = $db->getConnection();
        }

        public function create($title, $content, $user_id, $created_at, $image = "") 
        {
            $query = "INSERT INTO " . $this->table . " (title, content, user_id, created_at) VALUES (:title, :content, :user_id, :created_at)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':created_at', $created_at);

            if($stmt->execute()) {
                return true;
            }

            return false;
        }
    }
?>