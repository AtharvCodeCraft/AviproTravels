<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
include '../includes/db.php';
include 'header.php';

$about_content = "";
$contact_content = "";

$result = $conn->query("SELECT * FROM site_content");
while($row = $result->fetch_assoc()){
    if($row['page'] == 'about') $about_content = $row['content'];
    if($row['page'] == 'contact') $contact_content = $row['content'];
}
?>

<div class="form-container">
    <h3>Site Content Settings</h3>
    <form action="settings_ops.php" method="post" style="margin-top: 20px;">
        <div class="form-group">
            <label>About Us Content</label>
            <textarea name="about_content" class="form-control" rows="8"><?php echo htmlspecialchars($about_content); ?></textarea>
        </div>
        <div class="form-group">
            <label>Contact Us Content</label>
            <textarea name="contact_content" class="form-control" rows="8"><?php echo htmlspecialchars($contact_content); ?></textarea>
        </div>
        <button type="submit" name="update_settings" class="btn btn-primary">Update Content</button>
    </form>
</div>

</div> <!-- End admin-main -->
</body>
</html>