<?php
include("util/session_manager.php");
include("util/database_manager.php");
session_start();
redirectIfNotLoggedIn();

$loggedInUser = getUser(getId());

#only administrators are allowed to delete users. deletes all customers that are assigned to the user aswell.
if($loggedInUser["permission"] == "Administrator") {
    $id = $_GET["id"];
    $query = "DELETE FROM customers WHERE users_id = $id";
    $results = executeStatement($query);

    $query = "DELETE FROM users WHERE id = $id";
    $results = executeStatement($query);
}

header("Location: user_list.php");
die();