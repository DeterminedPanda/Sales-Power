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
        <form method="get" action="customer_list.php">
            <select name="column">
                <option value="id" selected>Id</option>
                <option value="firstname">Vorname</option>
                <option value="lastname">Nachname</option>
                <option value="users_id">Sachbearbeiter</option>
            </select>

            <select name="order">
                <option value="ASC">Aufsteigend</option>
                <option value="DESC">Absteigend</option>
            </select>

            <Button type="submit">Sortieren</Button>
        </form>
    </div>

    <div class="list">
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
            $loggedInUser = getCurrentUser(getId());
            $conn = createConnection();
            $column = $_GET["column"] ?? "id";
            $order = $_GET["order"] ?? "ASC";
            $sql = "SELECT customers.id, customers.firstname, customers.lastname, customers.users_id, users.username FROM customers INNER JOIN users on customers.users_id = users.id ORDER BY $column $order";
            $customers = $conn->query($sql);

            while ($row = $customers->fetch_assoc()) {
                echo "<tr>";
                echo "<td> $row[id]</td>";
                echo "<td> $row[firstname]</td>";
                echo "<td> $row[lastname]</td>";
                echo "<td> $row[username]</td>";
                echo "<td>";
                echo "<a href='customer_view.php?id=$row[id]' class='button'>Einsehen</a>";
                #only Administrators and the responsible User are allowed to delete customers
                if ($loggedInUser["permission"] == "Administrator" OR $loggedInUser["id"] == $row["users_id"]) {
                    echo "<a href='delete_customer.php?id=$row[id]' class='button red'>Löschen</a>";
                }
                echo "</td>";
                echo "</tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
    <a href="add_customer.php" class="button float-right m-t-10 green">Kunde Hinzufügen</a>
</div>

<?php include("footer.html"); ?>

</body>
</html>