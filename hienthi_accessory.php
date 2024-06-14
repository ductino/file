<?php

require("connect.php");


if(isset($_POST['delete'])) {
    $selected_accessories = $_POST['selected_accessories'];
    foreach($selected_accessories as $accessory_id) {

        $sql = "DELETE FROM accessories WHERE id = $accessory_id";
        
        if ($conn->query($sql) !== TRUE) {
            echo "Lỗi khi xóa dữ liệu: " . $conn->error;
        }
    }
}


$sql_select = "SELECT * FROM accessories";
$result = $conn->query($sql_select);
$accessories = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $accessories[] = $row;
    }
}


$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Phụ Kiện</title>
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

        .accessory {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            position: relative;
        }

        .accessory h3 {
            margin-top: 0;
        }

        .accessory p {
            margin: 10px 0;
        }

        .accessory .price {
            font-weight: bold;
            color: #007bff;
        }

        .accessory img {
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
        <h2>Danh Sách Phụ Kiện</h2>
        <form action="" method="post">
            <?php foreach ($accessories as $accessory): ?>
                <div class="accessory">
                    <input type="checkbox" name="selected_accessories[]" value="<?php echo $accessory['id']; ?>">
                    <h3><?php echo $accessory['ten_phukien']; ?></h3>
                    <img src="<?php echo $accessory['img']; ?>" alt="<?php echo $accessory['ten_phukien']; ?>">
                    <p class="price">Giá: <?php echo $accessory['gia']; ?></p>
                    <a href="update_accessory.php?id=<?php echo $accessory['id']; ?>" class="edit-btn">Sửa</a>
                </div>
            <?php endforeach; ?>
            <button type="submit" name="delete" class="delete-btn">Xóa Dữ Liệu</button>
            <button type="button"><a href="admin.php">Admin</a></button>
        </form>
    </div>
</body>
</html>
