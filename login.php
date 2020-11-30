<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">
<head>
    <title>Sales Power - Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>

<?php
include("util/session_manager.php");
session_start();

if (isset($_POST["username"]) && isset($_POST["password"])) { #check if POST request
    $userData = validateLoginInformation($_POST["username"], $_POST["password"]);
    if (isset($userData)) {
        initializeSessionParameters($userData["username"], $userData["id"]);
    } else {
        $error = "Die eingegebenen Anmeldeinformationen sind ungültig.";
    }
}

if (isLoggedIn()) { #redirect if already logged in else login form is shown
    header("Location: index.php");
    die();
}
?>

<form method="post" action="login.php">
    <div id="container">
        <div id="image-container">
            <img src="images/logo.png" alt="logo" id="logo">
        </div>

        <label><b>Benutzername:</b>
            <input type="text" maxlength="32" minlength="4" name="username"
                   placeholder="Geben Sie hier Ihren Benutzernamen ein" required/>
        </label>
        <br>
        <br>

        <label><b>Passwort:</b>
            <input type="password" maxlength="32" minlength="4" name="password"
                   placeholder="Geben Sie hier Ihr Passwort ein" required/>
        </label>
        <br>
        <br>

        <Button type="submit" id="login-button">Anmelden</Button>

        <?php
        if (isset($error)) {
            echo "<p style='color: #ff0000;'>$error</p>";
        }
        ?>

    </div>
</form>

<?php include("footer.html"); ?>

</body>
</html>
