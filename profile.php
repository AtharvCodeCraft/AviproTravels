<?php
session_start();
if(!isset($_SESSION["user_loggedin"]) || $_SESSION["user_loggedin"] !== true){
    header("location: login.php");
    exit;
}
include 'includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Avipro Travels</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <section class="section-padding">
        <div class="container">
            <h1 class="text-center">My Profile</h1>
            
            <div style="background: white; padding: 30px; border-radius: 10px; box-shadow: var(--shadow); margin-bottom: 40px;">
                <h2>Personal Details</h2>
                <p><strong>Name:</strong> <?php echo htmlspecialchars($_SESSION["user_name"]); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION["user_email"]); ?></p>
                <a href="logout_user.php" class="btn btn-outline" style="margin-top: 10px;">Logout</a>
            </div>

            <h2 style="margin-bottom: 20px;">My Bookings</h2>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; background: white; box-shadow: var(--shadow); border-radius: 10px; overflow: hidden;">
                    <thead>
                        <tr style="background: #f1f5f9;">
                            <th style="padding: 15px; text-align: left;">Booking ID</th>
                            <th style="padding: 15px; text-align: left;">Destination</th>
                            <th style="padding: 15px; text-align: left;">Travel Date</th>
                            <th style="padding: 15px; text-align: left;">Persons</th>
                            <th style="padding: 15px; text-align: left;">Status</th>
                            <th style="padding: 15px; text-align: left;">Date Booked</th>
                            <th style="padding: 15px; text-align: left;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $user_id = $_SESSION["user_id"];
                        $sql = "SELECT * FROM bookings WHERE customer_id = ? ORDER BY created_at DESC";
                        if($stmt = $conn->prepare($sql)){
                            $stmt->bind_param("i", $user_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    $status = isset($row['status']) ? $row['status'] : 'Pending';
                                    $status_color = 'black';
                                    if($status == 'Pending') $status_color = 'orange';
                                    if($status == 'Confirmed') $status_color = 'green';
                                    if($status == 'Cancelled') $status_color = 'red';

                                    echo "<tr>";
                                    echo "<td style='padding: 15px; border-bottom: 1px solid #eee;'>#" . $row['id'] . "</td>";
                                    echo "<td style='padding: 15px; border-bottom: 1px solid #eee;'>" . htmlspecialchars($row['destination']) . "</td>";
                                    echo "<td style='padding: 15px; border-bottom: 1px solid #eee;'>" . $row['travel_date'] . "</td>";
                                    echo "<td style='padding: 15px; border-bottom: 1px solid #eee;'>" . $row['num_persons'] . "</td>";
                                    echo "<td style='padding: 15px; border-bottom: 1px solid #eee; color: $status_color; font-weight: bold;'>" . $status . "</td>";
                                    echo "<td style='padding: 15px; border-bottom: 1px solid #eee;'>" . $row['created_at'] . "</td>";
                                    echo "<td style='padding: 15px; border-bottom: 1px solid #eee;'>";
                                    if($status == 'Pending'){
                                        echo "<a href='cancel_booking.php?id=" . $row['id'] . "&redirect=profile' style='color: red; text-decoration: none; font-weight: bold;' onclick='return confirm(\"Are you sure you want to cancel this booking?\")'>Cancel</a>";
                                    } else {
                                        echo "-";
                                    }
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7' style='padding: 15px; text-align: center;'>No bookings found.</td></tr>";
                            }
                            $stmt->close();
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
