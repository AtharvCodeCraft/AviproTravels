<?php
session_start();
if(isset($_SESSION["user_loggedin"]) && $_SESSION["user_loggedin"] === true){
    header("location: profile.php");
    exit;
}
include 'includes/db.php';

$name = $email = $phone = $password = $secret_key = "";
$name_err = $email_err = $phone_err = $password_err = $secret_key_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate Name
    if(empty(trim($_POST["name"]))){
        $name_err = "Please enter your name.";
    } else{
        $name = trim($_POST["name"]);
    }

    // Validate Email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email.";
    } else{
        $email = trim($_POST["email"]);
        // Check if email exists
        $sql = "SELECT id FROM customers WHERE email = ?";
        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("s", $param_email);
            $param_email = $email;
            if($stmt->execute()){
                $stmt->store_result();
                if($stmt->num_rows == 1){
                    $email_err = "This email is already taken.";
                }
            }
            $stmt->close();
        }
    }

    // Validate Phone
    if(empty(trim($_POST["phone"]))){
        $phone_err = "Please enter your phone number.";
    } else{
        $phone = trim($_POST["phone"]);
    }

    // Validate Password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate Secret Key
    if(empty(trim($_POST["secret_key"]))){
        $secret_key_err = "Please enter a secret key.";
    } else{
        $secret_key = trim($_POST["secret_key"]);
    }

    if(empty($name_err) && empty($email_err) && empty($phone_err) && empty($password_err) && empty($secret_key_err)){
        $sql = "INSERT INTO customers (name, email, phone, password, secret_key) VALUES (?, ?, ?, ?, ?)";
        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("sssss", $param_name, $param_email, $param_phone, $param_password, $param_secret_key);
            $param_name = $name;
            $param_email = $email;
            $param_phone = $phone;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_secret_key = $secret_key; // Storing as plain text for simplicity as per request, or could be hashed

            if($stmt->execute()){
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
    <title>Sign Up - Avipro Travels</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <section class="section-padding">
        <div class="container">
            <div class="login-container">
                <h2>Create Account</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                        <span class="help-block" style="color:red;"><?php echo $name_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                        <span class="help-block" style="color:red;"><?php echo $email_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>">
                        <span class="help-block" style="color:red;"><?php echo $phone_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                        <span class="help-block" style="color:red;"><?php echo $password_err; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Secret Key (For Password Recovery)</label>
                        <input type="text" name="secret_key" class="form-control" placeholder="e.g. My first pet's name" value="<?php echo $secret_key; ?>">
                        <span class="help-block" style="color:red;"><?php echo $secret_key_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Sign Up">
                    </div>
                    <p>Already have an account? <a href="login.php" style="color: var(--secondary-color);">Login here</a>.</p>
                </form>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
