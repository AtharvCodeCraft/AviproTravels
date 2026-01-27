<?php
session_start();
include 'includes/db.php';

$response = array('success' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $destination = trim($_POST['destination']);
    $travel_date = trim($_POST['travel_date']);
    $num_persons = trim($_POST['num_persons']);
    $message = trim($_POST['message']);
    
    $customer_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;

    if (empty($name) || empty($email) || empty($phone) || empty($destination) || empty($travel_date) || empty($num_persons)) {
        $response['message'] = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = 'Invalid email format.';
    } else {
        $sql = "INSERT INTO bookings (customer_id, name, email, phone, destination, travel_date, num_persons, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("isssssis", $customer_id, $name, $email, $phone, $destination, $travel_date, $num_persons, $message);

            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'Your booking enquiry has been sent successfully!';
            } else {
                $response['message'] = 'Something went wrong. Please try again later.';
            }
            $stmt->close();
        } else {
            $response['message'] = 'Something went wrong. Please try again later.';
        }
    }
    $conn->close();
} else {
    $response['message'] = 'Invalid request method.';
}

header('Content-Type: application/json');
echo json_encode($response);
?>