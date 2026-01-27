<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Packages - Avipro Travels</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <section class="hero" style="height: 50vh; background-image: url('https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');">
        <div class="container">
            <h1>Our Exclusive Packages</h1>
            <p>Choose from our wide range of premium travel destinations.</p>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            <div class="packages-grid">
                <?php
                include 'includes/db.php';
                $sql = "SELECT * FROM packages";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $image_path = !empty($row['image']) ? "public/images/" . $row['image'] : "https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80";
                        if (strpos($row['image'], 'http') === 0) {
                             $image_path = $row['image'];
                        }

                        echo '<div class="package-card">';
                        echo '<div class="package-image"><img src="' . htmlspecialchars($image_path) . '" alt="' . htmlspecialchars($row['name']) . '"></div>';
                        echo '<div class="package-content">';
                        echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
                        echo '<span class="package-price">₹' . number_format($row['price']) . '</span>';
                        echo '<p>' . substr(htmlspecialchars($row['description']), 0, 100) . '...</p>';
                        echo '<a href="package-details.php?id=' . $row['id'] . '" class="btn btn-outline" style="margin-top: 15px;">View Details</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p class="text-center">No packages found.</p>';
                }
                $conn->close();
                ?>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
</body>
</html>