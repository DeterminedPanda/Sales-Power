<?php
include("util/session_manager.php");
include("util/database_manager.php");
session_start();
redirectIfNotLoggedIn();

$loggedInUser = getUser(getId());
if($loggedInUser["permission"] != "Administrator") {
    header("Location: user_list.php");
    die();
}

$id = $_GET["id"];
$query = "DELETE FROM customers WHERE users_id = $id";
$results = executeStatement($query);

$query = "DELETE FROM users WHERE id = $id";
$results = executeStatement($query);

header("Location: user_list.php");
?>