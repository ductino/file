<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <style>
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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $id = $_POST['id'];
            $type = $_POST['type'];
            $quantity = $_POST['quantity'];
            $price = get_price($id, $type); 
     
            save_to_database($id, $type, $quantity, $price);

            echo "<div class='product'>";
            echo "<img src='get_img.php?id=$id&type=$type' alt='Product Image'>";
            echo "<div class='product-info'>";
            echo "<h3>Sản phẩm ID: $id</h3>";
            echo "<p>Số lượng: $quantity</p>";
            echo "<p>Giá: $" . number_format($price, 2) . "</p>";
            echo "</div>";
            echo "</div>";
        } else {
            echo "<p>Không có sản phẩm trong giỏ hàng.</p>";
        }

        // Hàm lấy giá sản phẩm từ CSDL (hoặc mock data)
        function get_price($id, $type) {
            // Trong ví dụ này, mock dữ liệu giá cố định
            return 100; // Thay bằng hàm truy vấn CSDL để lấy giá thực tế
        }

        // Hàm lưu thông tin sản phẩm vào cơ sở dữ liệu
        function save_to_database($id, $type, $quantity, $price) {
       
            require("connect.php");


            $sql = "INSERT INTO carts (product_id, product_type, quantity, price) 
                    VALUES ('$id', '$type', '$quantity', '$price')";

        
            if ($conn->query($sql) === TRUE) {
                echo "Sản phẩm đã được thêm vào giỏ hàng thành công.";
            } else {
                echo "Lỗi: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
        ?>
    </div>
</body>
</html>
