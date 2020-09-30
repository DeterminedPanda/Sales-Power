<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">
<head>
    <title>Sales Power - Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>

<?php
include("session_manager.php");
session_start();
if (isset($_POST["username"])) {
    initializeSessionParameters($_POST["username"]);
}
?>

<?php if (isLoggedIn()): ?>
    welcome back <?php echo getUsername(); ?>!
    <form method="post" action="logout.php">
        <Button type="submit">Logout</Button>
    </form>
<?php else: ?>
    <form method="post" action="login.php">
        <div id="container">
            <div id="image-container">
                <img src="images/logo.png" id="logo">
            </div>

            <label><b>Benutzername:</b></label>
            <input type="text" name="username" placeholder="Geben Sie hier Ihren Benutzernamen ein" required/>
            <br>
            <br>
            <label><b>Passwort:</b></label>
            <input type="password" name="password" placeholder="Geben Sie hier Ihr Passwort ein" required/>
            <br>
            <br>
            <Button type="submit" id="login-button">Anmelden</Button>
        </div>
    </form>
<?php endif; ?>

<?php include("footer.html"); ?>

</body>
</html>
