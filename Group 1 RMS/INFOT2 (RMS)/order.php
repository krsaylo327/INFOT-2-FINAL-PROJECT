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

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the POST data, ensuring it's set and valid
    $item_name = isset($_POST['item']) ? $_POST['item'] : '';
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;
    $price = isset($_POST['price']) ? (float)$_POST['price'] : 0;
    $restaurant_name = isset($_POST['restaurant_name']) ? $_POST['restaurant_name'] : ''; // Ensure you collect this

    // Check if all fields are filled correctly
    if (empty($item_name) || $quantity <= 0 || $price <= 0 || empty($restaurant_name)) {
        echo "Please provide all the required details.";
    } else {
        $total_amount = $quantity * $price;

        // Optional: You can replace this with an actual customer name if available (using session for example)
        $customer_name = "Guest"; // Replace with session data if you have a login system

        // Insert order into the database
        $sql = "INSERT INTO orders (item, quantity, price, total_price, restaurant_name) 
                VALUES ('$item_name', $quantity, $price, $total_amount, '$restaurant_name')";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            echo "<h3>Order placed successfully!</h3>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
