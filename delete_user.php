<?php
include("util/session_manager.php");
include("util/database_manager.php");
session_start();
redirectIfNotLoggedIn();

$id = $_GET["id"];
$conn = createConnection();
$sql = "DELETE FROM users WHERE id = $id";
$results = $conn->query($sql);
$conn->close();

header("Location: user_list.php");
?>
?>