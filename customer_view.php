<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">
<head>
    <title>Sales Power - Kunde</title>
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

#check if POST request and then update the currently viewed customer with the passed new information
if (isset($_POST["users_id"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["birthday"])) {
    $query = "UPDATE customers SET users_id = '$_POST[users_id]', firstname = '$_POST[firstname]', 
                     lastname = '$_POST[lastname]', birthday= '$_POST[birthday]', note =  '$_POST[note]' WHERE id = $_GET[id]";
    $results = executeStatement($query);
    header("Location: customer_list.php");
    die();
}

$customer = getCustomer($_GET["id"]);
?>

<?php include("menu.html"); ?>

<div id="content">
    <h1>Kunde</h1>

    <form method="post" action="#">
        <label><b>Vorname:</b>
            <input type="text" maxlength="32" minlength="1" name="firstname"
                   placeholder="Geben Sie hier den Vornamen ein" value="<?php echo "$customer[firstname]"; ?>"
                   required/>
        </label>
        <br>
        <br>

        <label><b>Nachname:</b>
            <input type="text" maxlength="32" minlength="1" name="lastname"
                   placeholder="Geben Sie hier den Nachnamen ein" value="<?php echo "$customer[lastname]"; ?>"
                   required/>
        </label>
        <br>
        <br>

        <label><b>Sachbearbeiter:</b><br>
            <select name="users_id" class="width-100p">
                <?php
                $query = "SELECT * FROM users";
                $users = executeStatement($query);

                #show all users in a <select> tag
                while ($row = $users->fetch_assoc()) {
                    if ($customer[users_id] == $row[id]) { #add "select" to option if current user id equals id of responsible user
                        echo "<option value='$row[id]' selected>$row[username]</option>";
                    } else {
                        echo "<option value='$row[id]'>$row[username]</option>";
                    }
                }
                ?>
            </select>
        </label>
        <br>
        <br>
        <label><b>Geburtstag:</b><br>
            <input type="date" name="birthday" value="<?php echo "$customer[birthday]"; ?>" required>
        </label>
        <br>
        <br>
        <label><b>Anmerkung:</b><br>
            <textarea name="note"><?php echo "$customer[note]"; ?></textarea>
        </label>
        <?php
        #only Administrators and the responsible User are allowed to update customer information
        $loggedInUser = getUser(getId());
        if ($loggedInUser["permission"] == "Administrator" or $loggedInUser["id"] == $customer["users_id"]) {
            echo "<Button type='submit' class='float-right m-t-10 green'>Kunde Aktualisieren</Button>";
        }
        ?>
    </form>
</div>

<?php include("footer.html"); ?>

</body>
</html>