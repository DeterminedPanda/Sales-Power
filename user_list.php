<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">
<head>
    <title>Sales Power - Benutzerliste</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
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
$loggedInUser = getCurrentUser(getId());
?>

<?php include("menu.html"); ?>
<div id="content">

    <div class="header">
        <h1>Benutzerliste</h1>
        <form method="get" action="user_list.php">
            <select name="column">
                <option value="id" selected>Id</option>
                <option value="username">Benutzername</option>
                <option value="permissions_id">Berechtigungslevel</option>
            </select>
            <select name="order">
                <option value="ASC">Aufsteigend</option>
                <option value="DESC">Absteigend</option>
            </select>
            <Button type="submit">Sortieren</Button>
        </form>
    </div>

    <div class="list" style="clear:both;">
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
            $column = $_GET["column"] ?? "id";
            $order = $_GET["order"] ?? "ASC";
            $sql = "SELECT users.id, username, permission FROM users INNER JOIN permissions on users.permissions_id = permissions.id ORDER BY $column $order";
            $results = $conn->query($sql);

            while ($row = $results->fetch_assoc()) {
                echo "<tr>";
                echo "<td> $row[id]</td>";
                echo "<td> $row[username]</td>";
                echo "<td> $row[permission]</td>";
                echo "<td>";
                if ($loggedInUser["permission"] == "Administrator") {
                    echo "<a href='user_view.php?id=$row[id]' class='button'>Einsehen</a>";
                    echo "<a href='delete_user.php?id=$row[id]' class='button red'>Löschen</a>";
                } else {
                    echo "-";
                }
                echo "</td>";
                echo "</tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
    <?php
    if ($loggedInUser["permission"] == "Administrator") {
        echo "<a href='add_user.php' class='button float-right m-t-10 green'>Benutzer Erstellen</a>";
    }
    ?>
</div>

<?php include("footer.html"); ?>

</body>
</html>