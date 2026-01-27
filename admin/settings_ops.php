<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}

if (isset($_POST['update_content'])) {
    $about_content = $_POST['about_content'];
    $contact_content = $_POST['contact_content'];

    $sql = "UPDATE site_content SET content = ? WHERE page = ?";
    
    if ($stmt = $conn->prepare($sql)) {
        // Update About Us
        $stmt->bind_param("ss", $about_content, $page_about);
        $page_about = 'about';
        $stmt->execute();

        // Update Contact Us
        $stmt->bind_param("ss", $contact_content, $page_contact);
        $page_contact = 'contact';
        $stmt->execute();

        $stmt->close();
    }
    header("location: settings.php");
}
?>