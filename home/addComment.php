<?php
session_start();
include('../dbconnection.php');

if (isset($_POST['post_id']) && isset($_POST['comment']) && isset($_POST['user_id'])) {
    $postId = $_POST['post_id'];
    $comment = $_POST['comment'];
    $userId = $_POST['user_id'];
    $user_id = $_SESSION['uid'];

    $username_query = "SELECT name FROM users WHERE u_id = '$user_id'";
    $username_result = mysqli_query($dbcon, $username_query);
    $username_row = mysqli_fetch_assoc($username_result);
    $username = $username_row['name'];

    $insertQuery = "INSERT INTO comments (post_id, user_id, comment_text,username) VALUES ('$postId', '$userId', '$comment','$username')";
    $insertResult = mysqli_query($dbcon, $insertQuery);

    if ($insertResult) {
        echo "Comment added successfully!";
    } else {
        echo "Error adding comment: " . mysqli_error($dbcon);
    }
} else {
    echo "Invalid data received.";
}
?>
