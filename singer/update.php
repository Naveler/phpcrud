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
$singer->name = $data['name'];
$singer->lastname = $data['lastname'];
$singer->startyear = $data['startyear'];

//call add function
if ($singer->update()) {
    echo "Successfully updated singer.<br>";
    echo '<a href="../">&#8592;Back</a>';
} else {
    echo "Couldn't update singer.";
    echo '<a href="../">&#8592;Back</a>';
}