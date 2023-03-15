<?php
    class Posts {
        public $tableName;

        function __construct($tableName) {
            $this->tableName = $tableName;
        }

        public function select() {
            global $dbconnect;

            $dbconnect->beginTransaction();
            $query = "SELECT * FROM " . $this->tableName . " ORDER BY post_id DESC";
            $result = $dbconnect->prepare($query);
            $result->execute();

            $indexIgnor = $result->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($result as $value) {
                $data[] = $value;
            }

            $dbconnect->commit();
            return $data;
        }

        public function selectOwner($userId) {
            global $dbconnect;
            $data = "";

            $dbconnect->beginTransaction();
            $query = "SELECT username FROM users WHERE user_id=" . $userId;
            $result = $dbconnect->prepare($query);
            $result->execute();

            $indexIgnor = $result->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($result as $value) {
                $data = $value;
            }

            $dbconnect->commit();
            return $data;
        }

        public function selectLikeCount($postId) {
            global $dbconnect;
            $data = null;

            $dbconnect->beginTransaction();
            $query = "SELECT count(user_id) FROM likes WHERE post_id=" . $postId;
            $result = $dbconnect->prepare($query);
            $result->execute();

            $indexIgnor = $result->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($result as $value) {
                $data = $value;
            }

            $dbconnect->commit();
            return $data;
        }

        public function selectComments($postId) {
            global $dbconnect;
            $data = null;

            $dbconnect->beginTransaction();
            $query = "SELECT description FROM posts INNER JOIN comments AS c ON posts.post_id = c.post_id WHERE c.post_id=" . $postId . " ORDER BY posts.post_id DESC";
            $result = $dbconnect->prepare($query);
            $result->execute();

            $indexIgnor = $result->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($result as $value) {
                $data = $value;
            }

            $dbconnect->commit();
            return $data;
        }

        public function insert($name, $thumbnail, $path, $licence, $autor, $url, $date, $userId) {
            global $dbconnect;

            $dbconnect->beginTransaction();
            $query = "INSERT INTO " . $this->tableName . "(name, thumbnail, path, licence, autor, url, date, user_id) VALUES(?,?,?,?,?,?,?,?)";
            $statement = $dbconnect->prepare($query);

            $statement->bindParam(1, $name, PDO::PARAM_STR);
            $statement->bindParam(2, $thumbnail, PDO::PARAM_STR);
            $statement->bindParam(3, $path, PDO::PARAM_STR);
            $statement->bindParam(4, $licence, PDO::PARAM_STR);
            $statement->bindParam(5, $autor, PDO::PARAM_STR);
            $statement->bindParam(6, $url, PDO::PARAM_STR);
            $statement->bindParam(7, $date, PDO::PARAM_STR);
            $statement->bindParam(8, $userId, PDO::PARAM_INT);
            $statement->execute();

            $dbconnect->commit();
        }
    }