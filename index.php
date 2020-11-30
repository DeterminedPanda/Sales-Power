<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">
<head>
    <title>Sales Power - Index</title>
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
<?php
include("util/session_manager.php");
session_start();
redirectIfNotLoggedIn();
?>

<?php include("menu.html"); ?>
<div id="content">
    <h1>Index</h1>
    Willkommen zurück <?php echo getUsername() ?>!
    <br>
    Ihr Berechtigungslevel ist <b>X</b>
    <br>
    Ihnen sind <b>0</b> Kunden zugeteilt
</div>
<?php include("footer.html"); ?>

</body>
</html>