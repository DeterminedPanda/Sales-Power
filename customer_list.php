<!DOCTYPE html>
<html lang="de">
<meta charset="UTF-8">
<head>
    <title>Sales Power - Kundenliste</title>
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
    <h1>Kundenliste</h1>

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
            $conn = createConnection();
            $sql = "SELECT customers.id, customers.firstname, customers.lastname, users.username FROM customers INNER JOIN users on customers.users_id = users.id";
            $results = $conn->query($sql);

            while ($row = $results->fetch_assoc()) {
                echo "<tr>";
                echo "<td> $row[id]</td>";
                echo "<td> $row[firstname]</td>";
                echo "<td> $row[lastname]</td>";
                echo "<td> $row[username]</td>";
                echo "<td>";
                echo "<a href='customer_view.php?id=$row[id]' class='button'>Einsehen</a>";
                echo "<a href='delete_customer.php?id=$row[id]' class='button red'>Löschen</a>";
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