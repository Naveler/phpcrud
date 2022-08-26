<?php

//posting headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

//include db and object files again
include_once '../config/Db.php';
include_once '../object/Song.php';

//initialize db connection
$database = new Db();
$db = $database->getConnection();

$song = new Song($db);

//read post data
$data = $_POST;

$song->id = $data['id'];

//call add function
if ($song->delete()) {
    echo "Successfully deleted song.<br>";
    echo '<a href="../">&#8592;Back</a>';
} else {
    echo "Couldn't delete song.";
    echo '<a href="../">&#8592;Back</a>';
}