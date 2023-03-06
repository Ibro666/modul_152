<?php
    class Comment {

        public function select() {
            global $dbconnect;

            $dbconnect->beginTransaction();
            $query = "SELECT post_id FROM comments";
            $result = $dbconnect->prepare($query);
            $result->execute();

            $indexIgnor = $result->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($result as $value) {
                $data[] = $value;
            }

            $dbconnect->commit();
            return $data;
        }

        public function insert($postId, $userId, $textDec) {
            global $dbconnect;

            $dbconnect->beginTransaction();
            $query = "INSERT INTO comments(user_id, post_id, description) VALUES(?,?,?)";
            $statement = $dbconnect->prepare($query);

            $statement->bindParam(1, $userId, PDO::PARAM_INT);
            $statement->bindParam(2, $postId, PDO::PARAM_INT);
            $statement->bindParam(3, $textDec, PDO::PARAM_STR);
            $statement->execute();

            $dbconnect->commit();
        }
    }