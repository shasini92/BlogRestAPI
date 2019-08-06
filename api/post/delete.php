<?php
// Headers (Accessible by anyone)
header('Access-Control-Allow-Origin: *');
// Type we want to accept
header('Content-Type: application/json');
// Which HTTP methods we want to allow
header('Access-Control-Allow-Methods: DELETE');
// Which Headers we want to allow
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Posts.php';

// Instantiate DB % connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new Post($db);

$post->id = isset($_GET['id']) ? $_GET['id'] : die();

// Delete post
if($post->delete()){
    echo json_encode(
        array('message' => 'Post Deleted.')
    );
}else{
    echo json_encode(
        array('message' => 'Post Not Deleted.')
    );
}