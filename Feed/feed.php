<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ακίνητα προς Ενοικίαση</title>
    <link rel="stylesheet" href="feed.css">
</head>
<body>
    <header>
        <h1>Ακίνητα προς Ενοικίαση</h1>
        <?php include '../navigation_bar.php'; ?>
    </header>
    <main>
        <div class="property_list" id="property_list">
            <?php
                $servername = "mysql:host=localhost;dbname=ds_estate";
                $username = "root";
                $password = "";

                try{
                    $conn = new PDO($servername, $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	    

                    $sql = "SELECT * FROM listing";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();

                    $listings = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($listings as $listing) {
                        echo "<div class='property'>";
                        echo "<h2>" . $listing['title'] . "</h2>";
                        echo "<p><strong>Περιοχή: </strong> " . $listing['region'] . "</p>";
                        echo "<p><strong>Δωμάτια: </strong> " . $listing['room'] . "</p>";
                        echo "<p class='price'><strong>Τιμή ανά Διανυκτέρευση:</strong> $" . $listing['price'] . "</p>";
                        echo "<img src='" . $listing['photo'] . "' alt='" . $listing['title'] . "' style='max-width: 100%; height: auto;'>";
                        echo '<br><a href="../Book/book.php?listing=' . urlencode(json_encode($listing)) . '">ΚΡΑΤΗΣΗ</a>';
                        echo "</div>";
                        echo "<hr style='color:green;'>";
                    }
                }
                catch(PDOException $e) {
                    echo "Connection failed: " - $e->getMessage();
                }
            ?>
        </div>
    </main>
    <?php include '../footer.php'; ?>
</body>
</html>
