<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

include '../includes/db.php';

// Get counts
$pkg_count = $conn->query("SELECT COUNT(*) as count FROM packages")->fetch_assoc()['count'];
$booking_count = $conn->query("SELECT COUNT(*) as count FROM bookings")->fetch_assoc()['count'];

include 'header.php';
?>

    <div class="dashboard-cards">
        <div class="card">
            <div class="card-info">
                <h3>Total Packages</h3>
                <p><?php echo $pkg_count; ?></p>
            </div>
            <div class="card-icon">
                <i class="fas fa-box"></i>
            </div>
        </div>
        <div class="card">
            <div class="card-info">
                <h3>Total Bookings</h3>
                <p><?php echo $booking_count; ?></p>
            </div>
            <div class="card-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>
    </div>

    <div class="admin-table-container">
        <h3>Recent Bookings</h3>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Destination</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM bookings ORDER BY created_at DESC LIMIT 5";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $status_color = 'black';
                        if($row['status'] == 'Pending') $status_color = 'orange';
                        if($row['status'] == 'Confirmed') $status_color = 'green';
                        if($row['status'] == 'Cancelled') $status_color = 'red';

                        echo "<tr>";
                        echo "<td>#" . $row['id'] . "</td>";
                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['destination']) . "</td>";
                        echo "<td style='color: $status_color; font-weight: bold;'>" . $row['status'] . "</td>";
                        echo "<td>" . $row['created_at'] . "</td>";
                        echo "<td>";
                        if($row['status'] != 'Cancelled'){
                            echo "<a href='../cancel_booking.php?id=" . $row['id'] . "&redirect=dashboard' class='action-btn btn-delete' style='padding: 5px 10px; font-size: 0.8rem;' onclick='return confirm(\"Are you sure you want to cancel this booking?\")'>Cancel</a>";
                        } else {
                            echo "Cancelled";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No bookings found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</div> <!-- End admin-main -->
</body>
</html>