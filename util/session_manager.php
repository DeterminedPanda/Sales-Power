<?php

function deleteSession() {
    $_SESSION = [];
    session_destroy();
}

function initializeSessionParameters($username, $id) {
    if(!isLoggedIn()) {
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
        $_SESSION["id"] = $id;
    }
}

function validateLoginInformation($username, $password) {
    include("util/database_manager.php");
    $conn = createConnection();
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $results = $conn->query($sql);
    $conn->close();
    $row = $results->fetch_assoc();
    return $row; # true if login information is correct, else false
}

function isLoggedIn() {
    return (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true);
}

function redirectIfNotLoggedIn() {
    if (!isLoggedIn()) {
        header("Location: login.php");
        die();
    }
}

function getUsername() {
    if(isLoggedIn()) {
        return $_SESSION["username"];
    } else {
        return "NULL";
    }
}

function getId() {
    if(isLoggedIn()) {
        return $_SESSION["id"];
    } else {
        return "NULL";
    }
}

function isAdmin() {
    #TODO implement function
    return false;
}

?>