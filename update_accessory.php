<?php

require("connect.php");


$ten_phukien = $mota = $gia = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];
    $ten_phukien = $_POST['ten_phukien'];
    $gia = $_POST['gia'];


    $sql = "UPDATE accessories SET ten_phukien='$ten_phukien', gia='$gia' WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Dữ liệu đã được cập nhật thành công";
    } else {
        echo "Lỗi khi cập nhật dữ liệu: " . $conn->error;
    }
}


$sql_select = "SELECT id, ten_phukien FROM accessories";
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
    <title>Sửa Dữ Liệu Phụ Kiện</title>
</head>
<body>
    <h2>Sửa Dữ Liệu Phụ Kiện</h2>
    <form action="" method="post">
        <label for="id">Chọn Phụ Kiện:</label><br>
        <select name="id" id="id">
            <?php foreach ($accessories as $accessory): ?>
                <option value="<?php echo $accessory['id']; ?>"><?php echo $accessory['ten_phukien']; ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <label for="ten_phukien">Tên Phụ Kiện:</label><br>
        <input type="text" id="ten_phukien" name="ten_phukien" value="<?php echo $ten_phukien; ?>"><br>
        <label for="mota">Mô Tả:</label><br>
        <textarea id="mota" name="mota"><?php echo $mota; ?></textarea><br>
        <label for="gia">Giá:</label><br>
        <input type="text" id="gia" name="gia" value="<?php echo $gia; ?>"><br><br>
        <input type="submit" value="Cập Nhật Dữ Liệu">
    </form>
</body>
</html>
