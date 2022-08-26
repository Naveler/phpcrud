<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//load db config and object files
include_once '../config/Db.php';
include_once '../object/Song.php';

//initialize db connection
$database = new Db();
$db = $database->getConnection();

$song = new Song($db);

$songs = $song->read();

$songs_count = $songs->rowCount();

if ($songs_count > 0) {
    $songs_list = array();
    while ($row = $songs->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        array_push($songs_list, $row);
    }
    echo json_encode($songs_list);
} else {
    echo "No songs found.";
}