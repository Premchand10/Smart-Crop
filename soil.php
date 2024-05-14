<?php
$dsn = 'mysql:host=localhost;dbname=smartcrop';
$username = 'root';
$password = '';

try {
    // Connect to the database
    $pdo = new PDO($dsn, $username, $password);

    // Construct the SQL query to select the latest data based on timestamp
    $sql = "SELECT moisture, motor FROM smartcrop ORDER BY time DESC LIMIT 1"; // Replace 'time' with the actual column name for timestamp

    // Execute the query
    $stmt = $pdo->query($sql);

    if ($stmt) {
        // Fetch the result as an associative array
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Output the moisture and motor values
            echo "Moisture Level: " . $result['moisture'] . "%<br>";
            echo "Motor Status: " . ($result['motor'] == 1 ? "ON" : "OFF");
        } else {
            // Handle case where no data is found
            echo "No data found";
        }
    } else {
        // Handle query execution error
        echo "Failed to execute query";
    }
} catch (PDOException $e) {
    // Handle database connection error
    echo "Database connection failed: " . $e->getMessage();
}
?>
