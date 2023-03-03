<?php
    class Posts {
        public $tableName;

        function __construct($tableName) {
            $this->tableName = $tableName;
        }

        public function select($name = null) {
            global $dbconnect;
            $data = "";

            $dbconnect->beginTransaction();
            $query = "SELECT * FROM " . $this->tableName . " WHERE name='" . $name . "'";
            $result = $dbconnect->prepare($query);
            $result->execute();

            $indexIgnor = $result->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($result as $value) {
                $data = $value;
            }

            $dbconnect->commit();
            return $data;
        }

        public function insert($name, $path) {
            global $dbconnect;

            $dbconnect->beginTransaction();
            $query = "INSERT INTO " . $this->tableName . "(name, pfad) VALUES(?,?)";
            $statement = $dbconnect->prepare($query);

            $statement->bindParam(1, $name, PDO::PARAM_STR);
            $statement->bindParam(2, $path, PDO::PARAM_STR);
            $statement->execute();

            $dbconnect->commit();
        }
    }