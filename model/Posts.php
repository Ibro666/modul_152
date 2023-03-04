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

        public function insert($name, $path, $thumbnail) {
            global $dbconnect;

            $dbconnect->beginTransaction();
            $query = "INSERT INTO " . $this->tableName . "(name, path, thumbnail) VALUES(?,?,?)";
            $statement = $dbconnect->prepare($query);

            $statement->bindParam(1, $name, PDO::PARAM_STR);
            $statement->bindParam(2, $thumbnail, PDO::PARAM_STR);
            $statement->bindParam(3, $path, PDO::PARAM_STR);
            $statement->execute();

            $dbconnect->commit();
        }
    }