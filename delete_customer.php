<?php
include("util/session_manager.php");
include("util/database_manager.php");
session_start();
redirectIfNotLoggedIn();

$loggedInUser = getUser(getId());
$customer = getCustomer($_GET["id"]);

#only Administrators and responsible User are allowed to delete customers
if($loggedInUser["permission"] == "Administrator" OR $loggedInUser["id"] == $customer["users_id"]) {
    $id = $_GET["id"];
    $query = "DELETE FROM customers WHERE id = $id";
    $results = executeStatement($query);
}

header("Location: customer_list.php");
die();
