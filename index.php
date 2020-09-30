<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<head>
<title>Sales Power - Index</title>
</head>
<body>

<?php
include("session_manager.php");
$tmp = session_start();
if($tmp) {
    echo isLoggedIn() ? "true" : "false";
    initializeSessionParameters();
    echo isLoggedIn() ? "true" : "false";
    echo "<br>Username:" .  getUsername();
} else {
    echo "ERROR!!!";
}
?>

<br>
<a href="list.php">next site hihi :)</a>

</body>
</html>
