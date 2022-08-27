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

$singer->id = $data['id'];

//call read function
$singers = $singer->read();
//go through each singer
while ($row = $singers->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    //return the json if it matches the request
    if($row['id'] == $data['id']) {
        echo json_encode($row);
    }
}