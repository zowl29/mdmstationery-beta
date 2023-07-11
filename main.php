<?php

require_once 'includes/dbh.inc.php';

$sql = "SELECT item_name, item_in_stock, item_image FROM inventory";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $itemImage = $row["item_image"];
        echo "Item Name: " . $row["item_name"];
        echo "In Stock: " . $row["item_in_stock"];
        echo "<img src='uploads/".$itemImage. "'>";
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <a href="includes/logout.inc.php" class="logoutButton">Log Out</a>
    </body>
</html>