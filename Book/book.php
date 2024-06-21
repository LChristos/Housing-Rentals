<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Κράτηση Ακινήτου</title>
    <link rel="stylesheet" href="book.css">
</head>
<body>
    <header>
        <h1>Κράτηση Ακινήτου</h1>
        <?php include '../navigation_bar.php'; 
            if (!isset($_COOKIE['user_id'])) {
                header("Location: ../Login_Register/login.php");
                exit();
            }
        ?>        
    </header>
    <main>
        <div class="property_details" id="property_details">
            <?php
                if (isset($_GET['listing'])) {//show the property_details
                    $listing_json = urldecode($_GET['listing']);
                    $listing = json_decode($listing_json, true);
                } else {
                    echo "Listing information not found.";
                    exit();
                }
                
                echo "<input type='hidden' id='listing_id' value='" . $listing['id'] . "'>";//HIDDEN ID
                echo "<h2>" . $listing['title'] . "</h2>";
                echo "<p><strong>Περιοχή: </strong> " . $listing['region'] . "</p>";
                echo "<p><strong>Δωμάτια: </strong> " . $listing['room'] . "</p>";
                echo "<p id='price'><strong>Τιμή ανά Διανυκτέρευση:</strong> $" . $listing['price'] . "</p>";
                echo "<img src='" . $listing['photo'] . "' alt='" . $listing['title'] . "' style='max-width: 100%; height: auto;'>";
            ?>

        </div>
        <form id="booking_date" method="POST" action="add_reservation.php">
            <div id="date" >
                <label for="start_date">Ημερομηνία Άφιξης:</label>
                <input type="date" id="start_date" name="start_date" required>
                <label for="finish_date">Ημερομηνία Αναχώρησης:</label>
                <input type="date" id="finish_date" name="finish_date" required>
                <button type="button" id="availability">Συνέχεια</button>

            </div>

            <div id="user_data" style="display:none;">
                <label for="name">Όνομα:</label>
                <input type="text" id="name" name="name" >
                <label for="surname">Επίθετο:</label>
                <input type="text" id="surname" name="surname" >
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" >
                <div id="amount"></div>

                <button type="submit" id="reserve">Καταχώρηση Κράτησης</button>
            </div>
        </form>
    </main>
    <?php include '../footer.php'; ?>
    <script src="book.js"></script>
</body>
</html>
