<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('location: ../index.php');
    exit();
}

include('header.php');
include('../dbconnection.php');

$user_id = $_SESSION['uid'];

// Fetch and display posts for the logged-in user
$query = "SELECT * FROM posts WHERE user_id = '$user_id'";
$result = mysqli_query($dbcon, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        body {
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }
        .post-container {
            background-color: white;
            border: 1px solid #ccc;
            margin: 10px;
            padding: 10px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .post {
            background-color: lightskyblue;
            border: 2px solid black;
            border-radius: 8px;
            width: 450px;
            display: flex;
            flex-direction: column;
            padding: 10px;
            margin-bottom: 20px;
        }

        .post-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .username {
            font-size: 18px;
            font-weight: bold;
        }

        .time {
            font-size: 14px;
            color: #888;
        }

        .img {
            width: 100%;
            max-height: 300px;
            border: 3px solid black;
            border-radius: 5px;
        }

        .counts {
            display: flex;
            justify-content: space-between;
            font-size: 16px;
            margin-top: 5px;
        }

        .caption {
            font-size: 18px;
            margin-top: 10px;
        }

        .delete-button {
            background-color: #ff3333;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>
    <!-- <div class="post-container">
        <?php
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='post'>";
                echo "<div class='post-header'>";
                echo "<span class='username'>{$row['username']}</span>";
                echo "<span class='time'>{$row['post_date']}</span>";
                echo "</div>";
                echo "<img class='img' src='../post_images/{$row['photo']}' alt='Post Image'>";
                echo "<div class='counts'>";
                echo "❤️ {$row['likes']}  ";
                echo "👎 {$row['dislikes']}";
                echo "</div>";
                echo "<p class='caption'>Caption: {$row['caption']}</p>";
                echo "<button class='delete-button' onclick='deletePost({$row['post_id']})'>Delete</button>";
                echo "</div>";
            }
        } else {
            echo "<p class='no-posts'>No posts available.</p>";
        }
        ?>
    </div> -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function deletePost(postId) {
            if (confirm("Are you sure you want to delete this post?")) {
                $.ajax({
                    type: "POST",
                    url: "deletePost.php",
                    data: { post_id: postId },
                    success: function(response) {
                        // Reload the page after successful deletion
                        location.reload();
                    }
                });
            }
        }
    </script>
</body>
</html>
