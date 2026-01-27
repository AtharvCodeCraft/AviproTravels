<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}

// Add Package
if (isset($_POST['add_package'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = basename($_FILES['image']['name']);
        $target_dir = "../public/images/";
        $target_file = $target_dir . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
    }

    $sql = "INSERT INTO packages (name, description, price, image) VALUES (?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssds", $name, $description, $price, $image);
        $stmt->execute();
        $stmt->close();
    }
    header("location: packages.php");
}

// Update Package
if (isset($_POST['update_package'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = basename($_FILES['image']['name']);
        $target_dir = "../public/images/";
        $target_file = $target_dir . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

        $sql = "UPDATE packages SET name=?, description=?, price=?, image=? WHERE id=?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssdsi", $name, $description, $price, $image, $id);
            $stmt->execute();
            $stmt->close();
        }
    } else {
        $sql = "UPDATE packages SET name=?, description=?, price=? WHERE id=?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssdi", $name, $description, $price, $id);
            $stmt->execute();
            $stmt->close();
        }
    }
    header("location: packages.php");
}

// Delete Package
if (isset($_GET['delete_package'])) {
    $id = $_GET['delete_package'];
    $sql = "DELETE FROM packages WHERE id=?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
    header("location: packages.php");
}
?>