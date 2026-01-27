<?php
session_start();
include 'includes/db.php';

$email = $secret_key = "";
$email_err = $secret_key_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email.";
    } else{
        $email = trim($_POST["email"]);
    }

    if(empty(trim($_POST["secret_key"]))){
        $secret_key_err = "Please enter your secret key.";
    } else{
        $secret_key = trim($_POST["secret_key"]);
    }

    if(empty($email_err) && empty($secret_key_err)){
        // Verify Email and Secret Key
        $sql = "SELECT id FROM customers WHERE email = ? AND secret_key = ?";
        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("ss", $email, $secret_key);
            if($stmt->execute()){
                $stmt->store_result();
                if($stmt->num_rows == 1){
                    $stmt->bind_result($id);
                    $stmt->fetch();
                    
                    // Store ID in session for reset page
                    $_SESSION['reset_user_id'] = $id;
                    header("location: reset_password.php");
                    exit;
                } else{
                    $secret_key_err = "Invalid email or secret key.";
                }
            }
            $stmt->close();
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Avipro Travels</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <section class="section-padding">
        <div class="container">
            <div class="login-container">
                <h2>Forgot Password</h2>
                <p>Enter your email and secret key to reset your password.</p>
                
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                        <span class="help-block" style="color:red;"><?php echo $email_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Secret Key</label>
                        <input type="text" name="secret_key" class="form-control" placeholder="Your secret recovery key" value="<?php echo $secret_key; ?>">
                        <span class="help-block" style="color:red;"><?php echo $secret_key_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Reset Password">
                    </div>
                    <p><a href="login.php" style="color: var(--secondary-color);">Back to Login</a></p>
                </form>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
