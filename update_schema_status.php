<?php
include 'includes/db.php';

// Add status column to bookings table
$sql_alter = "ALTER TABLE bookings ADD COLUMN status ENUM('Pending', 'Confirmed', 'Cancelled') DEFAULT 'Pending' AFTER message";

if ($conn->query($sql_alter) === TRUE) {
    echo "Column 'status' added to 'bookings' table successfully.<br>";
} else {
    // Check if column already exists
    if (strpos($conn->error, "Duplicate column name") !== false) {
        echo "Column 'status' already exists.<br>";
    } else {
        echo "Error altering table: " . $conn->error . "<br>";
    }
}

echo "Database updated successfully!";
?>
