<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Δημιουργία Αγγελίας</title>
    <link rel="stylesheet" href="listing.css">
</head>
<body>
    <header>
        <h1>Δημιουργία Αγγελίας</h1>
        <?php include '../navigation_bar.php'; 
            if (!isset($_COOKIE['user_id'])) {
                header("Location: ../Login_Register/login.php");
                exit();
            }
        ?>
    </header>
    <main>
        <form id="create_listing_form" method="post" action="new_listing.php">
            <label for="photo">Φωτογραφία ακινήτου:</label>
            <input type="file" id="photo" name="photo" accept="image/*" required>
            <label for="title">Τίτλος:</label>
            <input type="text" id="title" name="title" required>
            <label for="region">Περιοχή:</label>
            <input type="text" id="region" name="region" required>
            <label for="room">Πλήθος δωματίων:</label>
            <input type="number" id="room" name="room" required>
            <label for="price">Τιμή ανά διανυκτέρευση:</label>
            <input type="number" id="price" name="price" required>

            <button type="submit">Δημιουργία Αγγελίας</button>
        </form>
    </main>
    <?php include '../footer.php'; ?>
    <script src="listing.js"></script>
</body>
</html>
