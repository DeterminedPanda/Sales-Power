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
$loggedInUser = getUser(getId());
?>

<?php include("menu.html"); ?>

<div id="content">

    <div class="header">
        <h1>Benutzerliste</h1>
        <details class="m-t-10">
            <summary style="text-align: right">Filter einblenden</summary>
            <form method="get" action="user_list.php">
                <input aria-label="search" type="text" name="search" placeholder="Tabelle nach Schlüsselwort durchsuchen..." class="filter"/>
                <Button type="submit">Suchen</Button>
            </form>
            <br>
            <form method="get" action="user_list.php">
                <select aria-label="column" name="column" class="sort">
                    <option value="id" selected>Id</option>
                    <option value="username">Benutzername</option>
                    <option value="permissions_id">Berechtigungslevel</option>
                </select>
                <select aria-label="order" name="order" class="sort">
                    <option value="ASC">Aufsteigend</option>
                    <option value="DESC">Absteigend</option>
                </select>
                <Button type="submit">Sortieren</Button>
            </form>
        </details>
    </div>

    <div class="list clear">
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
            $keyword = $_GET["search"] ?? ""; #parameter search is the keyword being filtered for in the datasets
            $column = $_GET["column"] ?? "id"; #column is the parameter that gets sorted for
            $order = $_GET["order"] ?? "ASC"; #order is eithr ascending (ASC) or descending (DESC)
            $query = "SELECT users.id, username, permission FROM users INNER JOIN permissions ON users.permissions_id = permissions.id 
                        WHERE users.id LIKE '%$keyword%' OR username LIKE '%$keyword%' OR permission LIKE '%$keyword%' ORDER BY $column $order";
            $results = executeStatement($query);

            #generate table of all users that are selected in $query
            while ($row = $results->fetch_assoc()) {
                echo "<tr>";
                echo "<td> $row[id]</td>";
                echo "<td> $row[username]</td>";
                echo "<td> $row[permission]</td>";
                echo "<td>";
                #only Administrators are allowed to have these options
                if ($loggedInUser["permission"] == "Administrator") {
                    echo "<a href='user_view.php?id=$row[id]' class='button'>Einsehen</a>";
                    echo "<a href='delete_user.php?id=$row[id]' class='button red'>Löschen</a>";
                } else {
                    echo "-";
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <?php
    #show the create user option only to administrators
    if ($loggedInUser["permission"] == "Administrator") {
        echo "<a href='add_user.php' class='button float-right m-t-10 green'>Benutzer Erstellen</a>";
    }
    ?>
</div>

<?php include("footer.html"); ?>

</body>
</html>