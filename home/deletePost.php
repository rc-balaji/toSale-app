<?php
include('../dbconnection.php');

if (isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];

    // Delete the post from the database
    $deleteQuery = "DELETE FROM posts WHERE post_id = '$post_id'";
    $deleteResult = mysqli_query($dbcon, $deleteQuery);

    if ($deleteResult) {
        echo "Post deleted successfully.";
    } else {
        echo "Error deleting post.";
    }
} else {
    echo "Invalid request.";
}
?>
