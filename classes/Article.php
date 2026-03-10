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

        public function getAllWithAutors($id)
        {
            $query = 
            "SELECT articles.*, users.username 
            FROM " . $this->table . 
            " JOIN users ON articles.user_id = :id
            WHERE users.id = :id
            ORDER BY articles.created_at DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }

            return false;
        }
    }
?>