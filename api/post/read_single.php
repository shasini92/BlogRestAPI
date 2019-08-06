<?php
// Headers (Accessible by anyone)
header('Access-Control-Allow-Origin: *');
// Type we want to accept
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Posts.php';

// Instantiate DB % connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new Post($db);

// Get ID from URL
$post->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get post (Call the read_single)
$result = $post->read_single($post->id);
$row = $result->fetch(PDO::FETCH_ASSOC);

// See if the post exists
$num = $result->rowCount();

if ($num > 0) {
    extract($row);
    
    // Create array
    $post_arr = array(
        'id' => $id,
        'title' => $title,
        'body' => $body,
        'author' => $author,
        'category_id' => $category_id,
        'category_name' => $category_name
    );
    
    // Make JSON
    print_r(json_encode($post_arr));
} else {
    // No post
    echo json_encode(
        array('message' => 'There is no post with that ID.')
    );
}

