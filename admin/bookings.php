<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
include '../includes/db.php';
include 'header.php';
?>

<div class="admin-table-container">
    <h3>All Bookings</h3>
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Destination</th>
                <th>Travel Date</th>
                <th>Persons</th>
                <th>Status</th>
                <th>Date Received</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM bookings ORDER BY created_at DESC";
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
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['destination']) . "</td>";
                    echo "<td>" . $row['travel_date'] . "</td>";
                    echo "<td>" . $row['num_persons'] . "</td>";
                    echo "<td style='color: $status_color; font-weight: bold;'>" . $row['status'] . "</td>";
                    echo "<td>" . $row['created_at'] . "</td>";
                    echo "<td>";
                    if($row['status'] != 'Cancelled'){
                        echo "<a href='../cancel_booking.php?id=" . $row['id'] . "' class='action-btn btn-delete' onclick='return confirm(\"Are you sure you want to cancel this booking?\")'>Cancel</a>";
                    } else {
                        echo "Cancelled";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='10'>No bookings found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</div> <!-- End admin-main -->
</body>
</html>
