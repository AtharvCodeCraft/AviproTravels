<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
include '../includes/db.php';
include 'header.php';
?>

<div class="form-container">
    <h3>Add / Edit Package</h3>
    <form action="packages_ops.php" method="post" enctype="multipart/form-data" style="margin-top: 20px;">
        <input type="hidden" name="id" id="package_id">
        <div class="form-group">
            <label>Package Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" id="description" class="form-control" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label>Price (₹)</label>
            <input type="number" name="price" id="price" class="form-control" step="0.01" required>
        </div>
        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" class="form-control">
            <small>Leave empty to keep existing image.</small>
        </div>
        <button type="submit" name="save_package" class="btn btn-primary">Save Package</button>
        <button type="button" onclick="resetForm()" class="btn btn-outline">Reset</button>
    </form>
</div>

<div class="admin-table-container">
    <h3>Existing Packages</h3>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM packages";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>₹" . number_format($row['price']) . "</td>";
                    echo "<td>";
                    echo "<button onclick='editPackage(" . json_encode($row) . ")' class='action-btn btn-edit'>Edit</button>";
                    echo "<a href='packages_ops.php?delete_package=" . $row['id'] . "' class='action-btn btn-delete' onclick='return confirm(\"Are you sure?\")'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No packages found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script>
function editPackage(pkg) {
    document.getElementById('package_id').value = pkg.id;
    document.getElementById('name').value = pkg.name;
    document.getElementById('description').value = pkg.description;
    document.getElementById('price').value = pkg.price;
    window.scrollTo(0, 0);
}

function resetForm() {
    document.getElementById('package_id').value = '';
    document.getElementById('name').value = '';
    document.getElementById('description').value = '';
    document.getElementById('price').value = '';
}
</script>

</div> <!-- End admin-main -->
</body>
</html>