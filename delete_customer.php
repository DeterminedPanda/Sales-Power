<?php
include("util/session_manager.php");
include("util/database_manager.php");
session_start();
redirectIfNotLoggedIn();

$id = $_GET["id"];
$conn = createConnection();
$sql = "DELETE FROM customers WHERE id = $id";
$results = $conn->query($sql);
$conn->close();

header("Location: customer_list.php");
?>
?>