<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<head>
    <title>Sales Power - List</title>
    <link rel="stylesheet" href="menu.css">
    <link rel="stylesheet" href="footer.css">
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

<h1>List :)</h1>

<?php include("footer.html"); ?>

</body>
</html>