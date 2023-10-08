<?php
// Add database connection and validation if necessary

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postId = $_POST['post_id'];

    // Assuming you have a database connection
    include('../dbconnection.php');

    // Implement the logic to update dislikes count in the database
    $updateDislikesQuery = "UPDATE posts SET dislikes = dislikes + 1 WHERE post_id = '$postId'";
    $result = mysqli_query($dbcon, $updateDislikesQuery);

    if ($result) {
        // Retrieve the updated dislikes count
        $getDislikesQuery = "SELECT dislikes FROM posts WHERE post_id = '$postId'";
        $dislikesResult = mysqli_query($dbcon, $getDislikesQuery);
        $row = mysqli_fetch_assoc($dislikesResult);
        $newDislikesCount = $row['dislikes'];

        $response = array('dislikes' => $newDislikesCount);
        echo json_encode($response);
    } else {
        // Handle error
        $response = array('error' => 'Failed to update dislikes count');
        echo json_encode($response);
    }
}
?>
