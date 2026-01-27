<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Trip - Avipro Travels</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <?php 
    if(session_status() === PHP_SESSION_NONE) session_start();
    include 'includes/header.php'; 
    ?>

    <section class="section-padding">
        <div class="container">
            <h1 class="text-center">Book Your Dream Vacation</h1>
            <p class="text-center" style="margin-bottom: 40px;">Fill out the form below and we'll get back to you shortly.</p>
            
            <div style="max-width: 600px; margin: 0 auto; background: white; padding: 40px; border-radius: 10px; box-shadow: var(--shadow-lg);">
                <form id="booking-form">
                    <?php
                    $u_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '';
                    $u_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : '';
                    // Phone is not in session by default in login, but we can leave it empty or fetch it. 
                    // For simplicity, let's just prefill name and email.
                    ?>
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($u_name); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($u_email); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="destination">Destination</label>
                        <input type="text" id="destination" name="destination" class="form-control" value="<?php echo isset($_GET['destination']) ? htmlspecialchars($_GET['destination']) : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="travel_date">Travel Date</label>
                        <input type="date" id="travel_date" name="travel_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="num_persons">Number of Persons</label>
                        <input type="number" id="num_persons" name="num_persons" class="form-control" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Additional Message</label>
                        <textarea id="message" name="message" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Submit Enquiry</button>
                    </div>
                    <div id="form-message"></div>
                </form>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    <script src="public/js/main.js"></script>
</body>
</html>