<?php

function createConnection() {
    $servername = "localhost"; #enter your servername here
    $dbname = "sales_power";
    $username = "root"; #enter your database username here (leave blank if no user authentication is enabled)
    $password = "root"; #enter your database password here (leave blank for no password)

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function executeStatement($query) {
    $conn = createConnection();
    $result = $conn->query($query);
    $conn->close();
    return $result;
}

function getUser($id) {
    $conn = createConnection();
    $sql = "SELECT users.id, username, permission FROM users INNER JOIN permissions on users.permissions_id = permissions.id WHERE users.id = $id";
    $result = $conn->query($sql)->fetch_assoc();
    $conn->close();
    return $result;
}

function getCustomer($id) {
    $conn = createConnection();
    $sql = "SELECT * FROM customers WHERE id = $id";
    $result = $conn->query($sql)->fetch_assoc();
    $conn->close();
    return $result;
}