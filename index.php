<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avipro Travels - Premium Travel Packages</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <section class="hero">
        <div class="container">
            <h1>Discover Your Next Adventure</h1>
            <p>Explore the world's most beautiful destinations with our curated travel packages.</p>
            <a href="packages.php" class="btn btn-primary">View Packages</a>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            <h2 class="text-center">Featured Packages</h2>
            <p class="text-center" style="margin-bottom: 40px;">Handpicked destinations for your perfect getaway.</p>
            
            <div class="packages-grid">
                <?php
                include 'includes/db.php';
                $sql = "SELECT * FROM packages LIMIT 3";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $image_path = !empty($row['image']) ? "public/images/" . $row['image'] : "https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80";
                        // If image is a full URL (from previous edits or placeholder), use it directly. 
                        // But existing logic in admin saves basename. So we need to check if file exists or use placeholder.
                        // For now, let's assume if it doesn't start with http, it's local.
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
                    echo '<p class="text-center">No packages available at the moment.</p>';
                }
                ?>
            </div>
            <div class="text-center" style="margin-top: 50px;">
                <a href="packages.php" class="btn btn-primary">View All Packages</a>
            </div>
        </div>
    </section>

    <section class="section-padding" style="background-color: #f1f5f9;">
        <div class="container">
            <div style="display: flex; align-items: center; gap: 50px; flex-wrap: wrap;">
                <div style="flex: 1;">
                    <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="About Us" style="border-radius: 10px; box-shadow: var(--shadow-lg);">
                </div>
                <div style="flex: 1;">
                    <h2>About Avipro Travels</h2>
                    <p style="margin-bottom: 20px;">
                        <?php
                        $about_sql = "SELECT content FROM site_content WHERE page='about'";
                        $about_result = $conn->query($about_sql);
                        if ($about_result->num_rows > 0) {
                            $about_row = $about_result->fetch_assoc();
                            echo nl2br(htmlspecialchars(substr($about_row['content'], 0, 300))) . '...';
                        } else {
                            echo "We are a premium travel agency dedicated to providing the best travel experiences.";
                        }
                        ?>
                    </p>
                    <a href="about.php" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
</body>
</html>