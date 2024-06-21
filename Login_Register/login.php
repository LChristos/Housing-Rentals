<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <header>
        <h1>Ενοικιάσεις Αυτοκινήτων</h1>
        <?php include '../navigation_bar.php'; ?>
    </header>
    <div class="frame" >
        <div id="form_login">
            <p>Δεν έχετε λογαριασμό; <a href="#" id="show_register">Εγγραφείτε εδώ</a></p><br/>
            <h2>Σύνδεση</h2>
            <form id="login" method="post" action="check_user.php">
                <label for="login_username">Όνομα Χρήστη:</label>
                <input type="text" id="login_username" name="username" required>
                <label for="login_password">Κωδικός Πρόσβασης:</label>
                <input type="password" id="login_password" name="password" required>
                <button type="submit">Σύνδεση</button>
            </form>            
        </div>

        <div id="form_register" style="display: none;">
            <p>Έχετε ήδη λογαριασμό; <a href="#" id="show_login">Συνδεθείτε εδώ</a></p><br/>
            <h2>Εγγραφή</h2>
            <form id="register" method="post" action="new_user.php">
                <label for="name">Όνομα:</label>
                <input type="text" id="name" name="user_name" required>
                <label for="surname">Επώνυμο:</label>
                <input type="text" id="surname" name="surname" required>
                <label for="register_username">Όνομα χρήστη:</label>
                <input type="text" id="register_username" name="username" required>
                <label for="register_password">Κωδικός Πρόσβασης:</label>
                <input type="password" id="register_password" name="password" required>
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
                <button type="submit" >Εγγραφή</button>
            </form>
        </div>
    </div>
    <?php include '../footer.php'; ?>
    <script src="login.js"></script>
</body>
</html>
