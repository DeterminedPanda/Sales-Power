<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">
<head>
    <title>Sales Power - Liste</title>
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
<?php
include("session_manager.php");
include("database_manager.php");
session_start();
if (!isLoggedIn()) {
    header("Location: login.php");
    die();
}
?>

<?php include("menu.html"); ?>
<div id="content">
    <h1>Benutzerliste</h1>

    <table>
        <thead>
        <tr>
            <th>Id</th>
            <th>Benutzername</th>
            <th>Aktionen</th>
        </tr>
        </thead>
        <?php
        $conn = createConnection();
        $sql = "SELECT * FROM users";
        $results = $conn->query($sql);

        while ($row = $results->fetch_assoc()) {
            echo "<tr>";
            echo "<td> $row[id]</td>";
            echo "<td> $row[username]</td>";
            echo "<td><Button>Einsehen</Button><Button>Löschen</Button></td>";
            echo "</tr>";
        }
        $conn->close();
        ?>
    </table>
</div>

<?php include("footer.html"); ?>

</body>
</html>