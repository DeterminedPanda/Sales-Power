<?php
include("util/session_manager.php");
include("util/database_manager.php");
session_start();
redirectIfNotLoggedIn();


#only Administrators and responsible User are allowed to delete customer information
$loggedInUser = getCurrentUser(getId());
$customer = getCustomer($_GET["id"]);
if($loggedInUser["permission"] != "Administrator" or $loggedInUser["id"] != $customer["users_id"]) {
    header("Location: customer_list.php");
    die();
}

$id = $_GET["id"];
$conn = createConnection();
$sql = "DELETE FROM customers WHERE id = $id";
$results = $conn->query($sql);
$conn->close();

header("Location: customer_list.php");
?>
?>