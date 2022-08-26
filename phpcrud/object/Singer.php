<?php

class Singer {

    private $conn;
    private $table_name = "singers";

    public $id;
    public $name;
    public $lastname;
    public $startyear;

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {
        // query to select all
        $query = "SELECT d.id, d.name, d.lastname, d.startyear
            FROM
                " . $this->table_name . " d
            ORDER BY
                d.id";
        // execute query
        $result = $this->conn->prepare($query);
        $result->execute();
        return $result;
    }

    function add() {
        $query = "INSERT INTO
        " . $this->table_name . "
        SET
            name=:name, 
            lastname=:lastname,  
            startyear=:startyear";
        $result = $this->conn->prepare($query);
        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->startyear = preg_replace("/[^0-9]/", "", $this->startyear);

        // bind values
        $result->bindParam(":name", $this->name);
        $result->bindParam(":lastname", $this->lastname);
        $result->bindParam(":startyear", $this->startyear);

        return $result->execute();
    }

    function update() {
        $query = "UPDATE
        " . $this->table_name . "
        SET
            name=:name, 
            lastname=:lastname,  
            startyear=:startyear
        WHERE
            id=:id";
        $result = $this->conn->prepare($query);
        // sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->lastname = htmlspecialchars(strip_tags($this->lastname));
        $this->startyear = preg_replace("/[^0-9]/", "", $this->startyear);

        // bind values
        $result->bindParam(":id", $this->id);
        $result->bindParam(":name", $this->name);
        $result->bindParam(":lastname", $this->lastname);
        $result->bindParam(":startyear", $this->startyear);

        return $result->execute();
    }

    function delete() {
        $query = "DELETE FROM
        " . $this->table_name . "
        WHERE
            id=:id";
        $result = $this->conn->prepare($query);

        // bind values
        $result->bindParam(":id", $this->id);

        return $result->execute();
    }
}