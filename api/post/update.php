<?php
// Headers (Accessible by anyone)
header('Access-Control-Allow-Origin: *');
// Type we want to accept
header('Content-Type: application/json');
// Which HTTP methods we want to allow
header('Access-Control-Allow-Methods: PUT');
// Which Headers we want to allow
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Posts.php';

// Instantiate DB % connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new Post($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

// Set ID to update
$post->id = $data->id;

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

// Update post
if($post->update()){
    echo json_encode(
        array('message' => 'Post Updated.')
    );
}else{
    echo json_encode(
        array('message' => 'Post Not Updated.')
    );
}