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
$data = $_POST;

$singer->id = $data['id'];

//call add function
if ($singer->delete()) {
    echo "Successfully deleted singer.<br>";
    echo '<a href="../">&#8592;Back</a>';
} else {
    echo "Couldn't delete singer.";
    echo '<a href="../">&#8592;Back</a>';
}