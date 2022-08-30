<?php

//posting headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

//include db and object files again
include_once '../config/Db.php';
include_once '../object/Singer.php';

//initialize db connection
$database = new Db();
$db = $database->getConnection();

$singer = new Singer($db);

//read post data
$data = json_decode(file_get_contents("php://input"), true);

$singer->name = $data['name'];

//call read function
$songs = $singer->getSongs();
$songs_count = $songs->rowCount();

//go through each song
if ($songs_count > 0) {
    $songs_list = array();
    while ($row = $songs->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        array_push($songs_list, $row);
    }
    echo json_encode($songs_list);
} else {
    echo json_encode("No songs found.");
}