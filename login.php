<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">
<head>
    <title>Sales Power - Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

<h1>Login</h1>

<?php
# debugging stuff start
echo $_SERVER['REQUEST_METHOD'] . "<br>";
# debugging stuff end

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
        <div class="imgcontainer">
            <img src="images/logo.png" class="logo">
        </div>

        <div class="container">
            <label><b>Benutzername:</b></label>
            <input type="text" name="username" placeholder="Geben Sie hier Ihren Benutzernamen ein" required/>
            <br>
            <br>
            <label><b>Passwort:</b></label>
            <input type="password" name="password" placeholder="Geben Sie hier Ihr Passwort ein" required/>
            <br>
            <br>
            <Button type="submit">Anmelden</Button>
        </div>
    </form>
<?php endif; ?>

</body>
</html>
