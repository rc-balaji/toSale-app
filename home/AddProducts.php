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
    $category = $_POST['category'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $condition = $_POST['condition'];
    $price = $_POST['price'];
    $photo_name = $_FILES['photo']['name'];
    $temp_name = $_FILES['photo']['tmp_name'];

    $username_query = "SELECT name FROM users WHERE u_id = '$user_id'";
    $username_result = mysqli_query($dbcon, $username_query);
    $username_row = mysqli_fetch_assoc($username_result);
    $username = $username_row['name'];

    move_uploaded_file($temp_name, "../product_images/$photo_name");

    if ($category === 'phone') {
        $brand_name = $_POST['brand_name'];
        $ram = $_POST['ram'];
        $rom = $_POST['rom'];

        $qry = "INSERT INTO products_phones (user_id, category, title, description, conditions, price, photo, brand_name, ram, rom, username)
                VALUES ('$user_id', '$category', '$title', '$description', '$condition', '$price', '$photo_name', '$brand_name', '$ram', '$rom', '$username')";
    } elseif ($category === 'bike' || $category === 'car') {
        $mileage = $_POST['mileage'];
        $kilometers_driven = $_POST['kilometers_driven'];

        $qry = "INSERT INTO products_" . $category . "s (user_id, category, title, description, conditions, price, photo, mileage, kilometers_driven, username)
                VALUES ('$user_id', '$category', '$title', '$description', '$condition', '$price', '$photo_name', '$mileage', '$kilometers_driven', '$username')";
    } elseif ($category === 'electronics') {
        $usage_time = $_POST['usage_time'];

        $qry = "INSERT INTO products_electronic (user_id, category, title, description, conditions, price, photo, usage_time, username)
                VALUES ('$user_id', '$category', '$title', '$description', '$condition', '$price', '$photo_name', '$usage_time', '$username')";
    } else {
        echo "<script>alert('Invalid category');</script>";
    }

    $result1 = mysqli_query($dbcon, $qry);

    if ($result1) {
        header('location: AddProducts.php'); // Redirect after successful submission
        echo "<script>alert('Product added successfully');</script>";
        exit();
    } else {
        echo "<script>alert('Error adding product');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
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
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        select,
        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        select {
            background-color: #f5f5f5;
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

        .image-preview {
            text-align: center;
            margin-top: 10px;
            border: 1px solid #ccc;
            padding: 5px;
            border-radius: 5px;
        }

        #imagePreview {
            max-width: 100%;
            max-height: 200px;
        }

        #phone-fields,
        #bike-fields,
        #car-fields,
        #electronics-fields {
            display: none;
            margin-top: 10px;
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body style="background-color:white">
    <div class="container">
        <div class="form-header">
            <h2>Add New Product</h2>
        </div>
        <div class="form-container">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category" id="category">
                        <option value="phone">Phone</option>
                        <option value="bike">Bike</option>
                        <option value="car">Car</option>
                        <option value="electronics">Electronics</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" placeholder="Enter product description" rows="4" cols="50"></textarea>
                </div>
                <div class="form-group">
                    <label for="condition">Condition</label>
                    <select name="condition">
                        <option value="new">New</option>
                        <option value="used">Used</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="price">Price ($)</label>
                    <input type="number" step="0.01" name="price">
                </div>
                <div class="form-group">
                    <label for="photo">Upload Photo</label>
                    <label class="custom-file-upload">
                        Choose File
                        <input type="file" name="photo" accept="image/*">
                    </label>
                </div>
                <div class="image-preview">
                    <img id="imagePreview" src="#" alt="Preview" style="display: none;">
                </div>
                <!-- Additional fields for each category -->
                <div class="form-group" id="phone-fields"> <!-- Displayed by default -->
                    <label for="brand_name">Brand Name</label>
                    <input type="text" name="brand_name">
                    <label for="ram">RAM (GB)</label>
                    <input type="number" name="ram">
                    <label for="rom">ROM (GB)</label>
                    <input type="number" name="rom">
                </div>
                <div class="form-group" id="bike-fields" style="display: none;">
                    <label for="mileage">Mileage (km/l)</label>
                    <input type="number"  name="mileage">
                    <label for="kilometers_driven">Kilometers Driven</label>
                    <input type="number" name="kilometers_driven">
                </div>
                <div class="form-group" id="car-fields" style="display: none;">
                    <label for="mileage">Mileage (km/l)</label>
                    <input type="number"  name="mileage">
                    <label for="kilometers_driven">Kilometers Driven</label>
                    <input type="number" name="kilometers_driven">
                </div>
                <div class="form-group" id="electronics-fields" style="display: none;">
                    <label for="usage_time">Usage Time</label>
                    <input type="text" name="usage_time">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Add Product">
                </div>
            </form>
        </div>
    </div>
    <script>
        const categorySelect = document.getElementById('category');
        const phoneFields = document.getElementById('phone-fields');
        const bikeFields = document.getElementById('bike-fields');
        const carFields = document.getElementById('car-fields');
        const electronicsFields = document.getElementById('electronics-fields');

        // Set the initial display for the phone category
        phoneFields.style.display = 'block';

        categorySelect.addEventListener('change', function () {
            const selectedCategory = this.value;
            phoneFields.style.display = selectedCategory === 'phone' ? 'block' : 'none';
            bikeFields.style.display = selectedCategory === 'bike' ? 'block' : 'none';
            carFields.style.display = selectedCategory === 'car' ? 'block' : 'none';
            electronicsFields.style.display = selectedCategory === 'electronics' ? 'block' : 'none';
        });

        const fileInput = document.querySelector('input[type="file"]');
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
