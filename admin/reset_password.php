<?php
include '../includes/db.php';

// The password to set
$new_password = 'password';

// Hash the password
$hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

// The username to update
$admin_username = 'admin';

// Prepare the SQL statement
$sql = "UPDATE admins SET password = ? WHERE username = ?";

if ($stmt = $conn->prepare($sql)) {
    // Bind the variables to the prepared statement as parameters
    $stmt->bind_param("ss", $hashed_password, $admin_username);

    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        echo "Admin password has been reset successfully to 'password'.";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close statement
    $stmt->close();
} else {
    echo "Error preparing statement: " . $conn->error;
}

// Close connection
$conn->close();
?>
