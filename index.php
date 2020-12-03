<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">
<head>
    <title>Sales Power - Index</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
<?php
include("util/session_manager.php");
include("util/database_manager.php");
session_start();
redirectIfNotLoggedIn();
?>

<?php include("menu.html"); ?>

<div id="content">

    <h1>Index</h1>
    <p class="font18">
    <?php
    $user = getUser(getId());
    echo "Willkommen zurück <b class='uppercase'>$user[username]</b>!<br>";
    if($user["permission"] == "Administrator") {
        echo "Ihr Berechtigungslevel ist <b>Administrator</b>, Sie haben vollen Zugriff auf alle Funktionen<br>";
    } else {
        echo "Ihr Berechtigungslevel ist <b>Sachbearbeiter</b>, Sie haben <b>nicht</b> Zugriff auf alle Funktionen<br>";
    }


    $query = "SELECT COUNT(firstname) as count FROM customers WHERE users_id = $user[id]";
    $result = executeStatement($query)->fetch_assoc();
    echo "Ihnen Sind <b>$result[count]</b> Kunden zugeteilt.";
    ?>
    </p>
    <br>
    <hr>
    <br>

    <h2>Vielen Dank dass Sie sich für <i>Sales Power</i> entschieden haben.</h2>
    <p class="font18">
        Sales Power ermöglicht es Ihnen:
        <ul>
        <li>
            Kundeninformationen zu hinterlegen
        </li>
        <li>
            Kunden einen Sachbearbeiter zu zuweisen
        </li>
        <li>
            Mit wenigen klicks neue Sachbearbeiter anzulegen
        </li>
        <li>
            Verwaltung Ihres CMS durch Berechtigungslevel
        </li>
        <li>
            ...und vieles mehr!
        </li>
    </ul>
    </p>
    <br>
    <br>
    <br>
    <br>
    <h1 class="text-center" >Mehr als 50.000 Unternehmen verschiedenster Größen und Branchen nutzen Sales Power, um ihre Kunden zu verwalten.</h1>

</div>

<?php include("footer.html"); ?>

</body>
</html>