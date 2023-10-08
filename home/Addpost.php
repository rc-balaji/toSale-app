<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('location: ../index.php');
    exit();
}

include('header.php');
include('../dbconnection.php');

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['uid'];
    $caption = $_POST['caption'];
    $photo_name = $_FILES['photo']['name'];
    $temp_name = $_FILES['photo']['tmp_name'];

    // Retrieve username from the users table based on user_id
    $username_query = "SELECT name FROM users WHERE u_id = '$user_id'";
    $username_result = mysqli_query($dbcon, $username_query);
    $username_row = mysqli_fetch_assoc($username_result);
    $username = $username_row['name'];

    move_uploaded_file($temp_name, "../post_images/$photo_name");

    $qry = "INSERT INTO posts (user_id, username, photo, caption) VALUES ('$user_id', '$username', '$photo_name', '$caption')";
    $result1 = mysqli_query($dbcon, $qry);

    if ($result1) {
        header('location: addpost.php'); // Redirect after successful submission
        echo "<script>alert('Post added successfully');</script>";
        exit();
    } else {
        echo "<script>alert('Error adding post');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {

            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input[type="file"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
          
            border-radius: 5px;
        }

        .form-group input[type="file"] {
            background-color: #f5f5f5;
            display: none; /* Hide the input */
        }

        .custom-file-upload {
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
        }

        .custom-file-upload:hover {
            background-color: #0056b3;
        }

        .form-group textarea {
            resize: vertical;
        }

        .form-group input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .form-header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 15px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .form-container {
            border: 1px solid #ccc;
            border-top: none;
            border-bottom-left-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        .image-preview {
            text-align: center;
            margin-top: 10px;
            border: 1px solid #ccc;
            padding: 5px;
            border-radius: 5px;
        }

        .image-preview img {
            max-width: 100%;
            max-height: 200px;
        }
    </style>
</head>
<body style="background-color:white" >
    <div class="container">
        <div class="form-header">
            <h2>Add New Post</h2>
        </div>
        <div class="form-container">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="photo">Upload Photo</label>
                    <label class="custom-file-upload">
                        Choose File
                        <input type="file" name="photo" accept="image/*" required>
                    </label>
                </div>
                <div class="form-group">
                    <label for="caption">Caption</label>
                    <textarea name="caption" placeholder="Write your caption here" rows="4" cols="50" required></textarea>
                </div>
                <div class="image-preview">
                    <img id="imagePreview" src="#" alt="Preview" style="display: none;">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Add Post">
                </div>
            </form>
        </div>
    </div>
    <script>
        const fileInput = document.querySelector('input[type="file"]');
        const imagePreview = document.getElementById('imagePreview');

        fileInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    imagePreview.style.display = 'block';
                    imagePreview.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
