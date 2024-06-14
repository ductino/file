<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Search Results</title>
<style>
    td {
        width: 30%;
    }
    .result {
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 10px;
        padding: 10px;
    }
    .result img {
        max-width: 100px;
        max-height: 100px;
    }
    button {
        text-decoration: none;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 10px;
        text-align: left;
    }
    a {
        text-decoration: none;
        color: inherit; /* Ensures link color inherits from parent */
    }
</style>
</head>
<body>
<h1>KẾT QUẢ TÌM KIẾM CÓ LIÊN QUAN</h1>

<?php
require("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['query'])) {
    $searchTerm = $conn->real_escape_string($_POST['query']);

    $sql = "(SELECT id_sanpham AS id, ten_sanpham AS name, gia, img, 'product' AS type FROM products WHERE ten_sanpham LIKE '%$searchTerm%')
            UNION
            (SELECT id AS id, ten_dichvu AS name, gia, img, 'service' AS type FROM services WHERE ten_dichvu LIKE '%$searchTerm%')
            UNION
            (SELECT id AS id, ten_phukien AS name, gia, img, 'accessory' AS type FROM accessories WHERE ten_phukien LIKE '%$searchTerm%')";

    $result = $conn->query($sql);

    if ($result === false) {
        echo "Error: " . $conn->error;
    } else {
        if ($result->num_rows > 0) {
            echo "<table>";
            while ($row = $result->fetch_assoc()) {
                echo '<tr class="result">';
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['gia'] . "</td>";
                echo "<td><img class='product-image' src='" . $row['img'] . "'></td>";
                echo "<td>";
                echo "<form action='add_to_cart.php' method='post'>";
                echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                echo "<input type='hidden' name='type' value='" . $row['type'] . "'>";
                echo "<input type='number' name='quantity' value='1' min='1' required>";
                echo "<button type='submit'>Thêm vào giỏ hàng</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No products found</p>";
        }
    }

    $conn->close();
}
?>

</body>
</html>
