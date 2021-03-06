<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">
<head>
    <title>Sales Power - Benutzer</title>
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

#check if POST request and then update user information with the passed POST parameters
if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["permission"])) {
    $query = "UPDATE users SET username = '$_POST[username]', password = '$_POST[password]', permissions_id = '$_POST[permission]' WHERE id = $_GET[id]";
    $results = executeStatement($query);
    header("Location: user_list.php");
    die();
}

#get the information of the currently viewed user
$id = $_GET["id"];
$query = "SELECT * FROM users where id=$id";
$user = executeStatement($query)->fetch_assoc();
?>

<?php include("menu.html"); ?>

<div id="content">
    <h1>Benutzer</h1>

    <form method="post" action="#">
        <label><b>Benutzername:</b>
            <input type="text" maxlength="32" minlength="4" name="username"
                   placeholder="Geben Sie hier Ihren Benutzernamen ein" value="<?php echo "$user[username]"; ?>"
                   required/>
        </label>
        <br>
        <br>

        <label><b>Passwort:</b>
            <input type="password" maxlength="32" minlength="4" name="password"
                   placeholder="Geben Sie hier Ihr Passwort ein" value="<?php echo "$user[password]"; ?>" required/>
        </label>
        <br>
        <br>

        <label><b>Berechtigungslevel:</b><br>
            <select name="permission" class="width-100p">
                <?php
                $query = "SELECT * FROM permissions";
                $permissions = executeStatement($query);

                #show all permissions in a <select> tag
                while ($row = $permissions->fetch_assoc()) {
                    if ($user["permissions_id"] == $row["id"]) { #add "select" to option if current permission id equals id of row
                        echo "<option value='$row[id]' selected>$row[permission]</option>";
                    } else {
                        echo "<option value='$row[id]'>$row[permission]</option>";
                    }
                }
                ?>
            </select>
        </label>
        <br>
        <Button type="submit" class="float-right m-t-10 green">Benutzer Aktualisieren</Button>
    </form>
</div>

<?php include("footer.html"); ?>

</body>
</html>