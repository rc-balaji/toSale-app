<?php
session_start();
include('header.php');
include('../dbconnection.php');

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $category = $_GET['category']; // Add this line to get the category from the URL
    
    // Determine the table name based on the category
    $table = "products_" . ($category === 'electronics' ? "electronic" : $category . 's');

    
    // Query the specific category table for the product
    $query = "SELECT * FROM $table WHERE product_id = $product_id";
    $result = mysqli_query($dbcon, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Display product details
        echo "<div class='container'>";
        echo "<h2>Product Details</h2>";
        echo "<div class='product-details'>";
        echo "<img src='../product_images/" . $row['photo'] . "' alt='Product Image' class='product-image'>";
        echo "<div class='product-info'>";
        echo "<h4>" . $row['title'] . "</h4>";
        echo "<p><strong>Category:</strong> " . $category . "</p>";
        echo "<p><strong>Description:</strong> " . $row['description'] . "</p>";
        echo "<p><strong>Condition:</strong> " . $row['conditions'] . "</p>";
        echo "<p><strong>Price:</strong> $" . $row['price'] . "</p>";
        
        // Display user details
        $user_id = $row['user_id'];
        $user_query = "SELECT * FROM users WHERE u_id = $user_id";
        $user_result = mysqli_query($dbcon, $user_query);
        
        if ($user_result && mysqli_num_rows($user_result) > 0) {
            $user_row = mysqli_fetch_assoc($user_result);
            echo "<h2>Seller Details</h2>";
            echo "<p><strong>Name:</strong> " . $user_row['name'] . "</p>";
            echo "<p><strong>Email:</strong> " . $user_row['email'] . "</p>";
            echo "<p><strong>Contact:</strong> " . $user_row['pnumber'] . "</p>";
        }
        
        // Add a "Place Order" button
        echo '<button class="place-order" onclick="alert(\'Order Placed\')">Place Order</button>';
        
        echo "</div>"; // Close the product-info div
        echo "</div>"; // Close the product-details div
        
        echo "</div>"; // Close the container div
    } else {
        echo "<p>Product not found.</p>";
    }
} else {
    echo "<p>Invalid product ID.</p>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Define your CSS styles here */
        .container {
            display: flex;
            flex-direction: column;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f0f0f0;
            align-items: center;
        }

        .product-details {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            gap: 20px;
        }

        .product-image {
            max-width: 200px;
            max-height: 200px;
        }

        .product-info {
            display: flex;
            flex-direction: column;
        }

        h2 {
            font-size: 24px;
            margin-top: 20px;
        }

        h4 {
            font-size: 20px;
            margin-top: 10px;
        }

        p {
            font-size: 16px;
            margin: 5px 0;
        }

        /* Style the "Place Order" button */
        .place-order {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            margin-top: 10px;
            font-size: 16px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <!-- Your HTML content goes here -->
</body>
</html>
