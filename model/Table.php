<?php
    class Table {
        public $tableName;

        function __construct($tableName) {
            $this->tableName = $tableName;
        }

        public function select($username) {
            global $dbconnect;
            $data = "";

            $dbconnect->beginTransaction();
            $query = "SELECT * FROM " . $this->tableName . " WHERE username='" . $username . "'";
            $result = $dbconnect->prepare($query);
            $result->execute();

            $indexIgnor = $result->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($result as $value) {
                $data = $value;
            }

            $dbconnect->commit();
            return $data;
        }

        public function selectProfile($userId) {
            global $dbconnect;

            $dbconnect->beginTransaction();
            $query = "SELECT * FROM " . $this->tableName . " WHERE user_id=" . $userId;
            $result = $dbconnect->prepare($query);
            $result->execute();

            $indexIgnor = $result->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($result as $value) {
                $data = $value;
            }

            $dbconnect->commit();
            return $data;
        }

        public function insert($firstName, $lastName, $username, $email, $pass) {
            global $dbconnect;

            $dbconnect->beginTransaction();
            $query = "INSERT INTO " . $this->tableName . "(firstname, lastname, username, email, password) VALUES(?,?,?,?,?)";
            $statement = $dbconnect->prepare($query);

            $statement->bindParam(1, $firstName, PDO::PARAM_STR);
            $statement->bindParam(2, $lastName, PDO::PARAM_STR);
            $statement->bindParam(3, $username, PDO::PARAM_STR);
            $statement->bindParam(4, $email, PDO::PARAM_STR);
            $statement->bindParam(5, $pass, PDO::PARAM_STR);
            $statement->execute();

            $dbconnect->commit();
        }

        public function update($firstName, $lastName, $username, $email, $pass, $userId) {
            global $dbconnect;

            $dbconnect->beginTransaction();
            $query = "UPDATE " .$this->tableName . " SET firstname=?, lastname=?, username=?, email=?, password=? WHERE user_id=" . $userId;
            $statement = $dbconnect->prepare($query);

            $statement->bindParam(1, $firstName, PDO::PARAM_STR);
            $statement->bindParam(2, $lastName, PDO::PARAM_STR);
            $statement->bindParam(3, $username, PDO::PARAM_STR);
            $statement->bindParam(4, $email, PDO::PARAM_STR);
            $statement->bindParam(5, $pass, PDO::PARAM_STR);
            $statement->execute();

            $dbconnect->commit();
        }
    }