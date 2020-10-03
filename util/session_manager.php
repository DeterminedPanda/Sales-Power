<?php

function deleteSession() {
    $_SESSION = [];
    session_destroy();
}

function initializeSessionParameters($username) {
    if(!isLoggedIn()) {
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
    }
}

function isLoggedIn() {
    return (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true);
}

function getUsername() {
    if(isLoggedIn()) {
        return $_SESSION["username"];
    } else {
        return "NULL";
    }
}

function isAdmin() {
    #TODO implement function
    return false;
}

?>