<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">
<head>
    <title>Sales Power - Kunde Hinzufügen</title>
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

#check if POST request and then add the passed information into the database
if (isset($_POST["users_id"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["birthday"])) {
    $query = "INSERT INTO customers (users_id, firstname, lastname, birthday, note) VALUES ('$_POST[users_id]', '$_POST[firstname]', '$_POST[lastname]', '$_POST[birthday]', '$_POST[note]')";
    $results = executeStatement($query);
    header("Location: customer_list.php");
    die();
}
?>

<?php include("menu.html"); ?>
<div id="content">
    <h1>Kunde Hinzufügen</h1>

    <form method="post" action="add_customer.php">
        <label><b>Vorname:</b>
            <input type="text" maxlength="32" minlength="1" name="firstname"
                   placeholder="Geben Sie hier den Vornamen ein" required/>
        </label>
        <br>
        <br>

        <label><b>Nachname:</b>
            <input type="text" maxlength="32" minlength="1" name="lastname"
                   placeholder="Geben Sie hier den Nachnamen ein" required/>
        </label>
        <br>
        <br>

        <label><b>Sachbearbeiter:</b><br>
            <select name="users_id" class="width-100p">
                <?php
                $query = "SELECT * FROM users";
                $users = executeStatement($query);

                #show all users in a <select> tag, so a responsible user can be selected for the customer
                while ($row = $users->fetch_assoc()) {
                    echo "<option value='$row[id]'>$row[username]</option>";
                }
                ?>
            </select>
        </label>
        <br>
        <br>
        <label><b>Geburtstag:</b><br>
            <input type="date" name="birthday" required>
        </label>
        <br>
        <br>
        <label><b>Anmerkung:</b><br>
            <textarea name="note"></textarea>
        </label>
        <Button type="submit" class="float-right m-t-10 green">Kunde Erstellen</Button>
    </form>
</div>

<?php include("footer.html"); ?>

</body>
</html>