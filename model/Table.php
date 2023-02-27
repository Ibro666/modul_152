<?php
    class Table {
        public $tableName;

        function __construct($tableName) {
            $this->tableName = $tableName;
        }

        public function select($username = null) {
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

        public function insert($username, $pass) {
            global $dbconnect;

            $dbconnect->beginTransaction();
            $query = "INSERT INTO " . $this->tableName . "(username, password) VALUES(?,?)";
            $statement = $dbconnect->prepare($query);

            $statement->bindParam(1, $username, PDO::PARAM_STR);
            $statement->bindParam(2, $pass, PDO::PARAM_STR);
            $statement->execute();

            $dbconnect->commit();
        }
    }