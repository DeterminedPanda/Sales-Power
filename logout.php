<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">
<head>
    <title>Sales Power - Logout</title>
</head>
<body>

<h1>Logout</h1>

<?php
include("session_manager.php");
session_start();
?>

<?php if (isLoggedIn()): deleteSession(); ?>
    Sie sind nun abgemeldet! Sie werden nun zur Anmeldeseite weitergeleitet...
<?php else: ?>
    Sie werden nun zur Anmeldeseite weitergeleitet...
<?php endif; ?>
<meta http-equiv="refresh" content="1; URL=login.php" />

</body>
</html>
