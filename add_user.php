<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">
<head>
    <title>Sales Power - Benutzer Erstellen</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
<?php
include("util/session_manager.php");
include("util/database_manager.php");
session_start();
redirectIfNotLoggedIn();

$loggedInUser = getUser(getId());
if ($loggedInUser["permission"] != "Administrator") { #only Administrators are allowed to view this site
    header("Location: user_list.php");
    die();
}

#check if POST request and then insert the new user into the database
if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["permission"])) {
    $query = "INSERT INTO users (username, password, permissions_id) VALUES ('$_POST[username]', '$_POST[password]', '$_POST[permission]')";
    $results = executeStatement($query);
    header("Location: user_list.php");
    die();
}
?>

<?php include("menu.html"); ?>
<div id="content">
    <h1>Benutzer Erstellen</h1>

    <form method="post" action="add_user.php" class="form">
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

        <label><b>Berechtigungslevel:</b><br>
            <select name="permission" class="width-100p">
                <?php
                $query = "SELECT * FROM permissions";
                $permissions = executeStatement($query);

                #show all permissions in a <select> tag, so a permission can be selected for the user
                while ($row = $permissions->fetch_assoc()) {
                    echo "<option value='$row[id]'>$row[permission]</option>";
                }
                ?>
            </select>
        </label>
        <br>
        <Button type="submit" class="float-right m-t-10 green">Benutzer Erstellen</Button>
    </form>
</div>

<?php include("footer.html"); ?>

</body>
</html>