<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Avipro Travels</title>
    <link rel="stylesheet" href="../public/css/style.css">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="admin-body">

<div class="admin-sidebar">
    <div class="logo">
        Avipro <span>Admin</span>
    </div>
    <nav>
        <a href="dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>"><i class="fas fa-tachometer-alt"></i> &nbsp; Dashboard</a>
        <a href="packages.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'packages.php' ? 'active' : ''; ?>"><i class="fas fa-box"></i> &nbsp; Packages</a>
        <a href="bookings.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'bookings.php' ? 'active' : ''; ?>"><i class="fas fa-calendar-check"></i> &nbsp; Bookings</a>
        <a href="settings.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : ''; ?>"><i class="fas fa-cog"></i> &nbsp; Settings</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> &nbsp; Logout</a>
    </nav>
</div>

<div class="admin-main">
    <div class="admin-header-top">
        <h2><?php echo ucfirst(basename($_SERVER['PHP_SELF'], '.php')); ?></h2>
        <div class="user-info">
            <span>Welcome, <strong><?php echo htmlspecialchars($_SESSION["username"]); ?></strong></span>
            <a href="logout.php" class="btn btn-outline" style="margin-left: 15px; font-size: 0.8rem; padding: 5px 15px;">Logout</a>
        </div>
    </div>