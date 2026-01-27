<?php
session_start();
include 'includes/db.php';

if(!isset($_SESSION['reset_user_id'])){
    header("location: forgot_password.php");
    exit;
}

$error = "";
$success = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if(empty($password) || strlen($password) < 6){
        $error = "Password must be at least 6 characters.";
    } elseif($password != $confirm_password){
        $error = "Passwords do not match.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $user_id = $_SESSION['reset_user_id'];
        
        $sql = "UPDATE customers SET password = ? WHERE id = ?";
        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("si", $hashed_password, $user_id);
            if($stmt->execute()){
                $success = "Your password has been reset successfully. <a href='login.php'>Login here</a>.";
                unset($_SESSION['reset_user_id']); // Clear session
            } else {
                $error = "Something went wrong.";
            }
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Avipro Travels</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <section class="section-padding">
        <div class="container">
            <div class="login-container">
                <h2>Set New Password</h2>
                
                <?php if(!empty($error)){ ?>
                    <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                        <?php echo $error; ?>
                    </div>
                <?php } ?>

                <?php if(!empty($success)){ ?>
                    <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                        <?php echo $success; ?>
                    </div>
                <?php } else { ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>New Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Update Password">
                    </div>
                </form>
                <?php } ?>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
