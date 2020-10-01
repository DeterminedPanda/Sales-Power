<?php

function createConnection()
{
    $servername = "localhost";
    $dbname = "sales_power";
    $username = "root";
    $password = "root";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function executeTransaction($conn, $query)
{
    try {
        $conn->beginTransaction();
        $conn->query($query);
        $conn->commit();
    } catch (Exception $e) {
        $conn->rollback();
        throw $e;
    }
}

/*function deleteMe()
{
    $sql2 = "INSERT INTO users (username, password) VALUES ('root', 'root')";
    $kekw = $conn->query($sql2);
    if ($kekw === TRUE) {
        echo $kekw["id"];
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }


    $sql2 = "SELECT * FROM users WHERE ID = 26";
    $kekw = $conn->query($sql2);
    if ($kekw->num_rows > 0) {
        while ($row = $kekw->fetch_assoc()) {
            echo "id: " . $row["id"] . " - Name: " . $row["username"] . " " . $row["password"] . "<br>";
        }
    }
}*/