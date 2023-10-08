<?php
session_start();
include('header.php');
include('../dbconnection.php');

if (isset($_SESSION['uid'])) {
    $user_id = $_SESSION['uid'];

    // Initialize an array to store the product categories
    $productCategories = ['phones', 'bikes', 'cars', 'electronic'];

    echo "<div class='container'>";
    echo "<h2>My Products</h2>";

    // Loop through each product category and fetch products associated with the user
    foreach ($productCategories as $category) {
        $table = "products_" . $category;
        $query = "SELECT * FROM $table WHERE user_id = $user_id";
        $result = mysqli_query($dbcon, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<h3>$category</h3>";
            echo "<div class='category'>";
            // Display products if there are any associated with your user ID
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='product'>";
                echo "<img src='../product_images/" . $row['photo'] . "' alt='Product Image'>";
                echo "<h4>" . $row['title'] . "</h4>";
                echo "<p><strong>Category:</strong> " . $category . "</p>";
                echo "<p><strong>Description:</strong> " . $row['description'] . "</p>";
                echo "<p><strong>Condition:</strong> " . $row['conditions'] . "</p>";
                echo "<p><strong>Price:</strong> $" . $row['price'] . "</p>";

                
                echo "</div>";
            }
            echo "</div>"; // Close the category flex container
        }
    }

    echo "</div>";
} else {
    echo "<p>Please log in to view your products.</p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Products</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        h3 {
            font-size: 20px;
            margin-top: 20px;
        }

        .category {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .product {
            flex: 0 1 calc(25% - 20px); /* Four products per row, considering the gap */
            border: 1px solid #ddd;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 20px;
        }

        .product img {
            max-width: 200px;
            max-height: 200px;
            margin: 0 auto 10px;
            display: block;
        }

        h4 {
            font-size: 18px;
            margin: 10px 0;
        }

        p {
            font-size: 16px;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    
</body>
</html>
