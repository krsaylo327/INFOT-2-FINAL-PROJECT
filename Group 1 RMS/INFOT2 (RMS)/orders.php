<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "food_tiger";  // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all orders from the database
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

// Start HTML output
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Orders</title>
    <link rel="stylesheet" href="style2.css"> <!-- Link to the CSS file -->
</head>
<body>';

echo "<header><h1>All Orders</h1></header>"; // Add header section

// Start displaying table of orders
echo "<section class='table-container'>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                    <th>Restaurant</th>
                </tr>
            </thead>
            <tbody>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['item'] . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>" . $row['total_price'] . "</td>";
        echo "<td>" . $row['restaurant_name'] . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No orders found</td></tr>";
}

echo "</tbody>
    </table>
</section>";

// Close connection
$conn->close();

echo '</body></html>';
?>
