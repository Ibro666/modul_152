<?php
    class Like {
        public function selectCount($postId) {
            global $dbconnect;

            $dbconnect->beginTransaction();
            $query = "SELECT count(user_id) FROM likes WHERE post_id=' . $postId . '";
            $result = $dbconnect->prepare($query);
            $result->execute();

            $indexIgnor = $result->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($result as $value) {
                $data = $value;
            }

            $dbconnect->commit();
            return $data;
        }

        public function select() {
            global $dbconnect;

            $dbconnect->beginTransaction();
            $query = "SELECT post_id FROM likes";
            $result = $dbconnect->prepare($query);
            $result->execute();

            $indexIgnor = $result->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($result as $value) {
                $data[] = $value;
            }

            $dbconnect->commit();
            return $data;
        }

        public function insert($userId, $postId) {
            global $dbconnect;

            $dbconnect->beginTransaction();
            $query = "INSERT INTO likes(user_id, post_id) VALUES(?,?)";
            $statement = $dbconnect->prepare($query);

            $statement->bindParam(1, $userId, PDO::PARAM_INT);
            $statement->bindParam(2, $postId, PDO::PARAM_INT);
            $statement->execute();

            $dbconnect->commit();
        }
    }