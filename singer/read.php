<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

//load db config and object files
include_once '../config/Db.php';
include_once '../object/Singer.php';

//initialize db connection
$database = new Db();
$db = $database->getConnection();

$singer = new Singer($db);

$singers = $singer->read();

$singers_count = $singers->rowCount();

if ($singers_count > 0) {
    $singers_list = array();
    while ($row = $singers->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        array_push($singers_list, $row);
    }
    echo json_encode($singers_list);
} else {
    echo json_encode("No singers found.");
}