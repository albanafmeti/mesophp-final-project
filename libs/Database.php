<?php

class Database {

    private $connection;

    function __construct() {

        $host = "127.0.0.1";   //ose thjesht: localhost
        $user = "c1_mesophp";
        $password = "mesophp";
        $db_name = "mesophp_db";

        try {

            $this->connection = new PDO("mysql:host=$host;dbname=$db_name", $user, $password);

            // Vendosim metoden sesi PDO-ja do te gjeneroje gabimet - ne form Exception:
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $ex) {

            echo "Lidhja deshtoi: " . $ex->getMessage();
            exit;

        }
    }

    public function insert(string $table, array $field_values) {

        $fushat = implode(',', array_keys($field_values));

        $parametrat = ':' . implode(', :', array_keys($field_values));
        $stmt = $this->connection->prepare("INSERT INTO $table ($fushat) VALUES ($parametrat);");

        foreach ($field_values as $key => $value) {

            $stmt->bindValue(":$key", $value);

        }

        $rezultati = $stmt->execute();

        if ($rezultati) {

            $id = $this->connection->lastInsertId();
            return $id;

        } else {

            $error = $stmt->errorInfo();
            return $error;

        }
    }

    public function update(string $table, array $field_values, string $where) {

        $fushe_vlerat = null;

        foreach ($field_values as $key => $value) {

            $fushe_vlerat .= "$key = :$key,";

        }

        $fushe_vlerat = rtrim($fushe_vlerat, ',');

        $stmt = $this->connection->prepare("UPDATE $table SET $fushe_vlerat WHERE $where");

        foreach ($field_values as $key => $value) {

            $stmt->bindValue(":$key", $value);

        }

        $rezultati = $stmt->execute();

        if ($rezultati)
            return $rezultati;
        else
            return $stmt->errorInfo();
    }


    public function select(string $sql, array $bindArray = array(), $fetchMode = PDO::FETCH_ASSOC) {

        $stmt = $this->connection->prepare($sql);

        foreach ($bindArray as $key => $value) {

            $stmt->bindValue("$key", $value);

        }

        $stmt->execute();

        return $stmt->fetchAll( $fetchMode );
    }


    public function delete(string $table, string $where, int $limit = 1) {

        return $this->connection->exec("DELETE FROM $table WHERE $where LIMIT $limit");

    }
}