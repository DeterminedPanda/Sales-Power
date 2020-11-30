<?php
include("util/session_manager.php");
include("util/database_manager.php");
session_start();
redirectIfNotLoggedIn();

$loggedInUser = getCurrentUser(getId());
if($loggedInUser["permission"] != "Administrator") {
    header("Location: user_list.php");
    die();
}

$id = $_GET["id"];
$conn = createConnection();
$sql = "DELETE FROM customers WHERE users_id = $id";
$results = $conn->query($sql);
$sql = "DELETE FROM users WHERE id = $id";
$results = $conn->query($sql);
$conn->close();

header("Location: user_list.php");
?>