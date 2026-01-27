<?php
include 'includes/db.php';

// Check if column already exists
$check_col = $conn->query("SHOW COLUMNS FROM customers LIKE 'secret_key'");

if ($check_col->num_rows == 0) {
    // Column doesn't exist, add it
    $sql_alter = "ALTER TABLE customers ADD COLUMN secret_key VARCHAR(255) NOT NULL DEFAULT 'mysecretkey' AFTER phone";
    
    if ($conn->query($sql_alter) === TRUE) {
        echo "Column 'secret_key' added to 'customers' table successfully.<br>";
    } else {
        echo "Error altering table: " . $conn->error . "<br>";
    }
} else {
    echo "Column 'secret_key' already exists. You are good to go!<br>";
}

echo "Database updated successfully!";
?>
