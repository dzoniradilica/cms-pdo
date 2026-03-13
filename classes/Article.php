<?php
    class Article {
        private $conn;
        private $table = 'articles';

        public function __construct()
        {
            $db = new Database();
            $this->conn = $db->getConnection();
        }

        public function create($title = '', $content = '', $user_id = '', $created_at = '', $image = null) 
        {
            $query = "INSERT INTO " . $this->table . " (title, content, user_id, created_at, image) VALUES (:title, :content, :user_id, :created_at, :image)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':content', $content);
            $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindValue(':created_at', $created_at);
            $stmt->bindValue(':image', $image);

            if ($image === null) {
                $stmt->bindValue(':image', null, PDO::PARAM_NULL);
            } else {
                $stmt->bindValue(':image', $image, PDO::PARAM_STR);
            }

            if($stmt->execute()) {
                return true;
            }

            return false;
        }

        public function getAll() {
            $query = "SELECT * FROM " . $this->table;
            $stmt = $this->conn->prepare($query);

            if($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }

            return false;
        }

        public function getAllWithAuthor($id)
        {
            $query = 
            "SELECT articles.*, users.username 
            FROM " . $this->table . 
            " JOIN users ON articles.user_id = :id
            WHERE users.id = :id
            ORDER BY articles.id DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_OBJ);
            }

            return false;
        }

        public function get($id) {
            $query = "SELECT * FROM " .$this->table . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue('id', $id, PDO::PARAM_INT);

            if($stmt->execute()) {
                return $stmt->fetch(PDO::FETCH_OBJ);
            }

            return false;
        }

        public function getWithAuthor($id, $user_id) {
            $query = 
            "SELECT articles.*, users.username FROM "
            . $this->table .
            " JOIN users ON articles.user_id = :user_id
            WHERE articles.id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

            if($stmt->execute()) {
                return $stmt->fetch(PDO::FETCH_OBJ);
            }

            return false;
        }

        public function update($id, $title, $content, $image, $created_at) {
            $query = "UPDATE " .$this->table . " SET title = :title, content = :content, image = :image, created_at = :created_at WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':content', $content);
            $stmt->bindValue(':image', $image);
            $stmt->bindValue(':created_at', $created_at);

            if($stmt->execute()) {
                return true;
            }

            return false;
        }

        public function delete($id) {
            $query = "DELETE FROM " . $this->table . " WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);

            if($stmt->execute()) {
                return true;
            }

            return false;
        }
    }
?>