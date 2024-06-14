<?php

require("connect.php");


if(isset($_POST['delete'])) {
    $selected_products = $_POST['selected_products'];
    foreach($selected_products as $product_id) {

        $sql = "DELETE FROM products WHERE id_sanpham = $product_id";
        
        if ($conn->query($sql) !== TRUE) {
            echo "Lỗi khi xóa dữ liệu: " . $conn->error;

        }
    }
}

$sql_select = "SELECT * FROM products";
$result = $conn->query($sql_select);
$products = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sản Phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .product {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            position: relative;
        }

        .product h3 {
            margin-top: 0;
        }

        .product p {
            margin: 10px 0;
        }

        .product .price {
            font-weight: bold;
            color: #007bff;
        }

        .product img {
            max-width: 100px    ;
            height: 100px; 
            display: block; 
            margin: 0 auto;
        }

        .delete-btn, .edit-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .edit-btn {
            background-color: #007bff;
            left: 700px;
            text-decoration:none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Danh Sách Sản Phẩm</h2>
        <form action="" method="post">
            <?php foreach ($products as $product): ?>
                <div class="product">
                    <input type="checkbox" name="selected_products[]" value="<?php echo $product['id_sanpham']; ?>">
                    <h3><?php echo $product['ten_sanpham']; ?></h3>
                    <img src="<?php echo $product['img']; ?>" alt="<?php echo $product['ten_sanpham']; ?>">
                    <p class="price">Giá: <?php echo $product['gia']; ?></p>
                    <a href="update_product.php?id=<?php echo $product['id_sanpham']; ?>" class="edit-btn">Sửa</a>
                </div>
            <?php endforeach; ?>
            <button type="submit" name="delete" class="delete-btn">Xóa Dữ Liệu</button>
            <button type="button"><a href="admin.php">Admin</a></button>
        </form>
    </div>
</body>
</html>
