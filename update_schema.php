<?php
include 'includes/db.php';

// Create customers table
$sql_customers = "CREATE TABLE IF NOT EXISTS customers (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

if ($conn->query($sql_customers) === TRUE) {
    echo "Table 'customers' created successfully.<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Add customer_id to bookings table
$sql_alter = "ALTER TABLE bookings ADD COLUMN customer_id INT(11) DEFAULT NULL AFTER id";
if ($conn->query($sql_alter) === TRUE) {
    echo "Column 'customer_id' added to 'bookings' table successfully.<br>";
} else {
    // Check if column already exists
    if (strpos($conn->error, "Duplicate column name") !== false) {
        echo "Column 'customer_id' already exists.<br>";
    } else {
        echo "Error altering table: " . $conn->error . "<br>";
    }
}

echo "Database updated successfully!";
?>
