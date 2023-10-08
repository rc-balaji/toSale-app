<?php
// Add database connection and validation if necessary

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = $_POST['post_id'];

    // Assuming you have a database connection
    include('../dbconnection.php');

    // Implement the logic to update likes count in the database
    $updateLikesQuery = "UPDATE posts SET likes = likes + 1 WHERE post_id = '$postId'";
    $result = mysqli_query($dbcon, $updateLikesQuery);

    if ($result) {
        // Retrieve the updated likes count
        $getLikesQuery = "SELECT likes FROM posts WHERE post_id = '$postId'";
        $likesResult = mysqli_query($dbcon, $getLikesQuery);
        $row = mysqli_fetch_assoc($likesResult);
        $newLikesCount = $row['likes'];

        $response = array('likes' => $newLikesCount);
        echo json_encode($response);
    } else {
        // Handle error
        $response = array('error' => 'Failed to update likes count');
        echo json_encode($response);
    }
}
?>
