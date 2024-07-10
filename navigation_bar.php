<?php
session_start();
?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <nav>
        <ul>
            <a href="../Feed/feed.php">Feed</a>
            <a href="../Listing/listing.php">Create Listing</a>
            <?php
                if (isset($_COOKIE['user_id'])) {
                    echo '<a href="../logout.php">Logout</a>';
                } 
                else {
                    echo '<a href="../Login_Register/login.php">Login/Register</a>';
                }
            ?>
        </ul>
    </nav>
</body>
</html>