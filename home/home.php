<?php
session_start();
include('header.php');
include('../dbconnection.php');

// Initialize an array to store the product categories
$productCategories = ['phones', 'bikes', 'cars', 'electronic'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products</title>
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

        .category {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .product {
            flex: 1;
            border: 1px solid #ddd;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
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

        .buy-button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            display: inline-block;
        }

        .buy-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>All Products</h2>
        <?php
        // Loop through each product category and fetch products
        foreach ($productCategories as $category) {
            $query = "SELECT * FROM products_" . $category;
            $result = mysqli_query($dbcon, $query);

            if (mysqli_num_rows($result) > 0) {
                echo "<h3>$category</h3>";
                echo "<div class='category'>";
                // Display products if there are any in the category
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='product'>";
                    echo "<img src='../product_images/" . $row['photo'] . "' alt='Product Image'>";
                    echo "<h4>" . $row['title'] . "</h4>";
                    echo "<p><strong>Category:</strong> " . $category . "</p>";
                    echo "<p><strong>Description:</strong> " . $row['description'] . "</p>";
                    echo "<p><strong>Condition:</strong> " . $row['conditions'] . "</p>";
                    echo "<p><strong>Price:</strong> $" . $row['price'] . "</p>";
                    
                    // Add "Buy Item" button with a link to buy.php
                    echo "<a href='buy.php?product_id={$row['product_id']}&category={$row['category']}' class='buy-button'>Buy Item</a>";
                    
                    // Add more details specific to each category as needed
                    echo "</div>";
                }
                echo "</div>"; // Close the category flex container
            } else {
                // Display a message if no products are found in the category
                // echo "<p>No $category products available.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
