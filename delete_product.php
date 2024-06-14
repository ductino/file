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
    $product_id = $_POST['product_id'];
    $sql = "DELETE FROM products WHERE id = '$product_id'"; 
    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}

$sql = "SELECT * FROM products";
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
            echo "<td>" . $row['id_sanpham'] . "</td>";
            echo "<td>" . $row['ten_sanpham'] . "</td>";
            echo "<td>" . $row['gia'] . "</td>";
            echo "<td><img class='product-image' src='" . $row['img'] . "'></td>"; 
            echo "<td>
                    <form method='post' action=''>
                        <input type='hidden' name='id_sanpham' value='" . $row['id_sanpham'] . "'>
                        <input type='submit' name='delete' value='Delete'>
                    </form>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No products found</td></tr>";
    }
    ?>
</table>

<?php
$conn->close();
?>

</body>
</html>
