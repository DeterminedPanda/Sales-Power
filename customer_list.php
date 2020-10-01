<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">
<head>
    <title>Sales Power - Liste</title>
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
<?php
include("session_manager.php");
session_start();
if (!isLoggedIn()) {
    header("Location: login.php");
    die();
}
?>

<?php include("menu.html"); ?>

<div id="content">
    <h1>Kundenliste</h1>
</div>

<?php include("footer.html"); ?>

</body>
</html>