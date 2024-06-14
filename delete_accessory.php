<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .product-image {
            width: 100px; 
            height: auto; 
        }
    </style>
</head>
<body>
<?php

require("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $accessory_id = $_POST['accessory_id'];
    $sql = "DELETE FROM accessories WHERE id = '$accessory_id'"; 
    if ($conn->query($sql) === TRUE) {
        echo "Accessory deleted successfully";
    } else {
        echo "Error deleting accessory: " . $conn->error;
    }
}

$sql = "SELECT * FROM accessories";
$result = $conn->query($sql);
?>


<table border="1px">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Img</th>
        <th>Actions</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>"; 
            echo "<td>" . $row['ten_phukien'] . "</td>"; 
            echo "<td>" . $row['gia'] . "</td>";
            echo "<td><img class='product-image' src='" . $row['img'] . "'></td>"; 
            echo "<td>
                    <form method='post' action=''>
                        <input type='hidden' name='accessory_id' value='" . $row['id'] . "'>";
            echo "<input type='submit' name='delete' value='Delete'>
                    </form>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No accessories found</td></tr>"; 
    }
    ?>
</table>

<?php
$conn->close();
?>

</body>
</html>
