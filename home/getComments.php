<?php
include('../dbconnection.php');

if (isset($_GET['post_id'])) {
    $postId = $_GET['post_id'];

    $query = "SELECT * FROM comments WHERE post_id = '$postId'";
    $result = mysqli_query($dbcon, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div>";
            echo "<p>{$row['username']}: {$row['comment_text']}</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No comments yet.</p>";
    }
} else {
    echo "Invalid request.";
}
?>
