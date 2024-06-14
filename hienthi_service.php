<?php
// Kết nối đến cơ sở dữ liệu
require("connect.php");

// Xử lý khi người dùng nhấn nút Xóa
if(isset($_POST['delete'])) {
    $selected_services = $_POST['selected_services'];
    foreach($selected_services as $service_id) {
        // Thực hiện truy vấn để xóa dữ liệu từ bảng services
        $sql = "DELETE FROM services WHERE id = $service_id";
        
        if ($conn->query($sql) !== TRUE) {
            echo "Lỗi khi xóa dữ liệu: " . $conn->error;
            // Thêm mã xử lý lỗi ở đây nếu cần
        }
    }
}

// Truy vấn để lấy danh sách các dịch vụ
$sql_select = "SELECT * FROM services";
$result = $conn->query($sql_select);
$services = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
}

// Đóng kết nối
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Dịch Vụ</title>
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

        .service {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            position: relative;
        }

        .service h3 {
            margin-top: 0;
        }

        .service p {
            margin: 10px 0;
        }

        .service .price {
            font-weight: bold;
            color: #007bff;
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
        <h2>Danh Sách Dịch Vụ</h2>
        <form action="" method="post">
            <?php foreach ($services as $service): ?>
                <div class="service">
                    <input type="checkbox" name="selected_services[]" value="<?php echo $service['id']; ?>">
                    <h3><?php echo $service['ten_dichvu']; ?></h3>
                    <p><?php echo $service['mota']; ?></p>
                    <p class="price">Giá: <?php echo $service['gia']; ?></p>
                    <a href="update_service.php?id=<?php echo $service['id']; ?>" class="edit-btn">Sửa</a>
                </div>
            <?php endforeach; ?>
            <button type="submit" name="delete" class="delete-btn">Xóa Dữ Liệu</button>
            <button type="submit"><a href="admin.php">Admin</a></button>
        </form>
    </div>
</body>
</html>
