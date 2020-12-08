<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">
<head>
    <title>Sales Power - Kundenliste</title>
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
?>

<?php include("menu.html"); ?>

<div id="content">

    <div class="header">
        <h1>Kundenliste</h1>
        <details class="m-t-10">
            <summary style="text-align: right">Filter einblenden</summary>
            <form method="get" action="customer_list.php">
                <input type="text" name="search" placeholder="Tabelle nach Schlüsselwort durchsuchen..."
                       class="filter" />
                <Button type="submit">Suchen</Button>
            </form>
            <br>
            <form method="get" action="customer_list.php">
                <select name="column" class="sort">
                    <option value="id" selected>Id</option>
                    <option value="firstname">Vorname</option>
                    <option value="lastname">Nachname</option>
                    <option value="users_id">Sachbearbeiter</option>
                </select>
                <select name="order" class="sort">
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
                <th>Vorname</th>
                <th>Nachname</th>
                <th>Sachbearbeiter</th>
                <th>Aktionen</th>
            </tr>
            </thead>
            <?php
            $loggedInUser = getUser(getId());
            $keyword = $_GET["search"] ?? "";
            $column = $_GET["column"] ?? "id";
            $order = $_GET["order"] ?? "ASC";
            $query = "SELECT customers.id, customers.firstname, customers.lastname, users_id, users.username FROM customers INNER JOIN users on customers.users_id = users.id 
                        WHERE customers.id LIKE '%$keyword%' OR customers.firstname LIKE '%$keyword%' OR customers.lastname LIKE '%$keyword%' OR users.username LIKE '%$keyword%' 
                        ORDER BY $column $order";
            $customers = executeStatement($query);

            while ($row = $customers->fetch_assoc()) {
                echo "<tr>";
                echo "<td> $row[id]</td>";
                echo "<td> $row[firstname]</td>";
                echo "<td> $row[lastname]</td>";
                echo "<td> $row[username]</td>";
                echo "<td>";
                echo "<a href='customer_view.php?id=$row[id]' class='button'>Einsehen</a>";
                #only Administrators and the responsible User are allowed to delete customers
                if ($loggedInUser["permission"] == "Administrator" or $loggedInUser["id"] == $row["users_id"]) {
                    echo "<a href='delete_customer.php?id=$row[id]' class='button red'>Löschen</a>";
                }
                echo "</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <a href="add_customer.php" class="button float-right m-t-10 green">Kunde Hinzufügen</a>
</div>

<?php include("footer.html"); ?>

</body>
</html>