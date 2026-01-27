<?php
include 'includes/db.php';

// Add reset_token and token_expiry columns to customers table
$sql_alter = "ALTER TABLE customers ADD COLUMN reset_token VARCHAR(255) DEFAULT NULL, ADD COLUMN token_expiry DATETIME DEFAULT NULL";

if ($conn->query($sql_alter) === TRUE) {
    echo "Columns 'reset_token' and 'token_expiry' added to 'customers' table successfully.<br>";
} else {
    // Check if column already exists
    if (strpos($conn->error, "Duplicate column name") !== false) {
        echo "Columns already exist.<br>";
    } else {
        echo "Error altering table: " . $conn->error . "<br>";
    }
}

echo "Database updated successfully!";
?>
