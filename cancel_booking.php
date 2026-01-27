<?php
session_start();
include 'includes/db.php';

if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];
    
    // Check if Admin
    $is_admin = (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true);
    
    // Check if Customer
    $is_customer = (isset($_SESSION["user_loggedin"]) && $_SESSION["user_loggedin"] === true);
    $customer_id = isset($_SESSION["user_id"]) ? $_SESSION["user_id"] : null;

    $redirect = isset($_GET['redirect']) ? $_GET['redirect'] : '';

    if ($is_admin) {
        // Admin can cancel any booking
        $sql = "UPDATE bookings SET status = 'Cancelled' WHERE id = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $booking_id);
            $stmt->execute();
            $stmt->close();
        }
        
        if ($redirect == 'dashboard') {
            header("location: admin/dashboard.php");
        } elseif ($redirect == 'profile') {
            header("location: profile.php");
        } else {
            header("location: admin/bookings.php");
        }
        exit;
    } elseif ($is_customer && $customer_id) {
        // Customer can only cancel their OWN booking
        $sql = "UPDATE bookings SET status = 'Cancelled' WHERE id = ? AND customer_id = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ii", $booking_id, $customer_id);
            $stmt->execute();
            $stmt->close();
        }
        
        if ($redirect == 'profile') {
            header("location: profile.php");
        } else {
            header("location: profile.php");
        }
        exit;
    } else {
        // Unauthorized
        header("location: index.php");
        exit;
    }
} else {
    header("location: index.php");
    exit;
}
?>
