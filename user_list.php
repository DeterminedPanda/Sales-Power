<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">
<head>
    <title>Sales Power - Benutzerliste</title>
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/footer.css">
</head>
<body>
<?php
include("util/session_manager.php");
include("util/database_manager.php");
session_start();
redirectIfNotLoggedIn();
?>

<?php include("menu.html"); ?>
<div id="content">
    <h1>Benutzerliste</h1>

    <div class="list">
        <table>
            <thead>
            <tr>
                <th>Id</th>
                <th>Benutzername</th>
                <th>Berechtigungslevel</th>
                <th>Aktionen</th>
            </tr>
            </thead>
            <?php
            $conn = createConnection();
            $sql = "SELECT users.id, username, permission FROM users INNER JOIN permissions on users.permissions_id = permissions.id";
            $results = $conn->query($sql);

            while ($row = $results->fetch_assoc()) {
                echo "<tr>";
                echo "<td> $row[id]</td>";
                echo "<td> $row[username]</td>";
                echo "<td> $row[permission]</td>";
                echo "<td>";
                echo "<a href='user_view.php?id=$row[id]' class='button'>Einsehen</a>";
                echo "<a href='delete_user.php?id=$row[id]' class='button red'>Löschen</a>";
                echo "</td>";
                echo "</tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
    <a href="add_user.php" class="button float-right m-t-10 green">Benutzer Erstellen</a>
</div>

<?php include("footer.html"); ?>

</body>
</html>