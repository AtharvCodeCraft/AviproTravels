<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Details - Avipro Travels</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <section class="section-padding">
        <div class="container">
            <?php
            include 'includes/db.php';
            $package_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

            if ($package_id > 0) {
                $sql = "SELECT * FROM packages WHERE id = ?";
                if ($stmt = $conn->prepare($sql)) {
                    $stmt->bind_param("i", $package_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows == 1) {
                        $package = $result->fetch_assoc();
                        $image_path = !empty($package['image']) ? "public/images/" . $package['image'] : "https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80";
                        if (strpos($package['image'], 'http') === 0) {
                             $image_path = $package['image'];
                        }
                        
                        echo '<div style="display: flex; flex-wrap: wrap; gap: 40px;">';
                        echo '<div style="flex: 1; min-width: 300px;">';
                        echo '<img src="' . htmlspecialchars($image_path) . '" alt="' . htmlspecialchars($package['name']) . '" style="border-radius: 10px; box-shadow: var(--shadow-lg); width: 100%;">';
                        echo '</div>';
                        
                        echo '<div style="flex: 1; min-width: 300px;">';
                        echo '<h1 style="font-size: 2.5rem; margin-bottom: 10px;">' . htmlspecialchars($package['name']) . '</h1>';
                        echo '<p style="font-size: 1.5rem; color: var(--secondary-color); font-weight: 700; margin-bottom: 20px;">₹' . number_format($package['price']) . '</p>';
                        echo '<div style="margin-bottom: 30px; line-height: 1.8;">' . nl2br(htmlspecialchars($package['description'])) . '</div>';
                        echo '<a href="booking.php?destination=' . urlencode($package['name']) . '" class="btn btn-primary">Book This Package</a>';
                        echo '</div>';
                        echo '</div>';

                    } else {
                        echo "<p class='text-center'>Package not found.</p>";
                    }
                    $stmt->close();
                }
            } else {
                echo "<p class='text-center'>Invalid package ID.</p>";
            }
            $conn->close();
            ?>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
</body>
</html>