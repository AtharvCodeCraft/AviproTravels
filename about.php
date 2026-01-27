<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Avipro Travels</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <section class="section-padding">
        <div class="container">
            <h1 class="text-center">About Us</h1>
            <div style="max-width: 800px; margin: 40px auto; background: white; padding: 40px; border-radius: 10px; box-shadow: var(--shadow-lg);">
                <div style="line-height: 1.8; font-size: 1.1rem;">
                    <?php
                    include 'includes/db.php';
                    $sql = "SELECT content FROM site_content WHERE page='about'";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo nl2br(htmlspecialchars($row['content']));
                    } else {
                        echo "We are a premium travel agency.";
                    }
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
</body>
</html>