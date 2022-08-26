<?php

class Song {

    private $conn;
    private $table_name = "songs";

    public $id;
    public $title;
    public $artist;
    public $year;

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {
        // query to select all
        $query = "SELECT d.id, d.title, d.artist, d.year
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
            title=:title, 
            artist=:artist,  
            year=:year";
        $result = $this->conn->prepare($query);
        // sanitize
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->artist = htmlspecialchars(strip_tags($this->artist));
        $this->year = preg_replace("/[^0-9]/", "", $this->year);

        // bind values
        $result->bindParam(":title", $this->title);
        $result->bindParam(":artist", $this->artist);
        $result->bindParam(":year", $this->year);

        return $result->execute();
    }

    function update() {
        $query = "UPDATE
        " . $this->table_name . "
        SET
            title=:title, 
            artist=:artist,  
            year=:year
        WHERE
            id=:id";
        $result = $this->conn->prepare($query);
        // sanitize
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->artist = htmlspecialchars(strip_tags($this->artist));
        $this->year = preg_replace("/[^0-9]/", "", $this->year);

        // bind values
        $result->bindParam(":id", $this->id);
        $result->bindParam(":title", $this->title);
        $result->bindParam(":artist", $this->artist);
        $result->bindParam(":year", $this->year);

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