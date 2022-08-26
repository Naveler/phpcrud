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

$song->title = $data['title'];
$song->artist = $data['artist'];
$song->year = $data['year'];

//call add function
if ($song->add()) {
    echo "Successfully added song.<br>";
    echo '<a href="../">&#8592;Back</a>';
} else {
    echo "Couldn't add song.";
    echo '<a href="../">&#8592;Back</a>';
}