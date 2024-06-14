<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <style>
        body{
            background-color:#E7DDFF;
        }
        .container {
            width: 80%;
            margin: 20px auto;
        }
        .product {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
        }
        .product img {
            width: 100px;
            height: auto;
            margin-right: 20px;
        }
        .product-info {
            flex: 1;
        }
        .product-info h3 {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Giỏ hàng</h1>
        <?php
        // Kết nối tới CSDL
        require("connect.php");

        // Truy vấn để lấy thông tin giỏ hàng với INNER JOIN
        $sql = "SELECT c.*, p.ten_sanpham AS ten_sanpham, p.img AS img, p.gia AS gia
                FROM carts c
                INNER JOIN products p ON c.product_id = p.id_sanpham AND c.product_type = 'product'
                UNION
                SELECT c.*, a.ten_phukien AS ten_sanpham, a.img AS img, a.gia AS gia
                FROM carts c
                INNER JOIN accessories a ON c.product_id = a.id AND c.product_type = 'accessory'
                UNION
                SELECT c.*, s.ten_dichvu AS ten_sanpham, s.img AS img, s.gia AS gia
                FROM carts c
                INNER JOIN services s ON c.product_id = s.id AND c.product_type = 'service'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<img src='" . $row["img"] . "' alt='" . $row["ten_sanpham"] . "'>";
                echo "<div class='product-info'>";
                echo "<h3>: " . $row["ten_sanpham"] . "</h3>";
                echo "<p>Số lượng: " . $row["quantity"] . "</p>";
                echo "<p>Giá: $" . number_format($row["price"], 2) . "</p>";
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>Không có sản phẩm trong giỏ hàng.</p>";
        }

        // Đóng kết nối sau khi sử dụng
        $conn->close();
        ?>
    </div>
</body>
</html>
