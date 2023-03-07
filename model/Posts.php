<?php
    class Posts {
        public $tableName;

        function __construct($tableName) {
            $this->tableName = $tableName;
        }

        public function select() {
            global $dbconnect;
            // $data = "";

            $dbconnect->beginTransaction();
            $query = "SELECT * FROM " . $this->tableName;
            $result = $dbconnect->prepare($query);
            $result->execute();

            $indexIgnor = $result->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($result as $value) {
                $data[] = $value;
            }

            $dbconnect->commit();
            return $data;
        }

        public function selectLikeCount($postId) {
            global $dbconnect;
            $data = null;

            $dbconnect->beginTransaction();
            $query = "SELECT count(user_id) FROM posts INNER JOIN likes ON posts.post_id = likes.post_id WHERE posts.post_id=" . $postId;
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
            $query = "SELECT description FROM posts INNER JOIN comments AS c ON posts.post_id = c.post_id WHERE c.post_id=" . $postId;
            $result = $dbconnect->prepare($query);
            $result->execute();

            $indexIgnor = $result->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($result as $value) {
                $data = $value;
            }

            $dbconnect->commit();
            return $data;
        }

        public function insert($name, $thumbnail, $path, $licence, $autor, $url, $date) {
            global $dbconnect;

            $dbconnect->beginTransaction();
            $query = "INSERT INTO " . $this->tableName . "(name, thumbnail, path, licence, autor, url, date) VALUES(?,?,?,?,?,?,?)";
            $statement = $dbconnect->prepare($query);

            $statement->bindParam(1, $name, PDO::PARAM_STR);
            $statement->bindParam(2, $thumbnail, PDO::PARAM_STR);
            $statement->bindParam(3, $path, PDO::PARAM_STR);
            $statement->bindParam(4, $licence, PDO::PARAM_STR);
            $statement->bindParam(5, $autor, PDO::PARAM_STR);
            $statement->bindParam(6, $url, PDO::PARAM_STR);
            $statement->bindParam(7, $date, PDO::PARAM_STR);
            $statement->execute();

            $dbconnect->commit();
        }
    }