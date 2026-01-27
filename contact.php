<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Avipro Travels</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <section class="section-padding">
        <div class="container">
            <h1 class="text-center">Contact Us</h1>
            <div style="max-width: 800px; margin: 40px auto; background: white; padding: 40px; border-radius: 10px; box-shadow: var(--shadow-lg);">
                <p style="margin-bottom: 20px; line-height: 1.8;">
                    <?php
                    include 'includes/db.php';
                    $sql = "SELECT content FROM site_content WHERE page='contact'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo nl2br(htmlspecialchars($row['content']));
                    } else {
                        echo "Contact us for any queries.";
                    }
                    $conn->close();
                    ?>
                </p>
                <div style="margin-top: 30px;">
                    <h3>Our Office</h3>
                    <p>123 Travel Lane, Wanderlust City</p>
                    <p>Email: info@aviprotravels.com</p>
                    <p>Phone: +1 234 567 890</p>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
</body>
</html>