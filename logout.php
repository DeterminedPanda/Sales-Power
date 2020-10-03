<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">
<head>
    <title>Sales Power - Logout</title>
</head>
<body>

<?php
include("util/session_manager.php");
session_start();
if (isLoggedIn())
    deleteSession();
header("Location: login.php");
die();
?>

</body>
</html>
