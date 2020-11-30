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

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["permission"])) { #check if POST request
    $conn = createConnection();
    $sql = "UPDATE users SET username = '$_POST[username]', password = '$_POST[password]', permissions_id = '$_POST[permission]' WHERE id = $_GET[id]";
    $results = $conn->query($sql);
    $conn->close();
    header("Location: user_list.php");
    die();
}

$loggedInUser = getCurrentUser(getId());
if ($loggedInUser["permission"] != "Administrator") { #only Administrators are allowed to view this site
    header("Location: user_list.php");
    die();
}

$conn = createConnection();
$id = $_GET["id"];
$sql = "SELECT * FROM users where id=$id";
$user = $conn->query($sql)->fetch_assoc();
$conn->close();
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
                $conn = createConnection();
                $sql = "SELECT * FROM permissions";
                $results = $conn->query($sql);

                while ($row = $results->fetch_assoc()) {
                    if ($user["permissions_id"] == $row["id"]) { #add "select" to option if current permission id equals id of row
                        echo "<option value='$row[id]' selected>$row[permission]</option>";
                    } else {
                        echo "<option value='$row[id]'>$row[permission]</option>";
                    }
                }
                $conn->close();
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