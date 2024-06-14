<?php
// Kết nối đến cơ sở dữ liệu
require("connect.php");

// Khai báo biến và thiết lập mặc định
$ten_dichvu = $mota = $gia = "";

// Kiểm tra xem có dữ liệu được gửi từ form không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $service_id = $_POST['service_id'];
    $ten_dichvu = $_POST['ten_dichvu'];
    $mota = $_POST['mota'];
    $gia = $_POST['gia'];

    // Thực hiện truy vấn để cập nhật dữ liệu trong bảng services
    $sql = "UPDATE services SET ten_dichvu='$ten_dichvu', mota='$mota', gia='$gia' WHERE id = $service_id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Dữ liệu đã được cập nhật thành công";
    } else {
        echo "Lỗi khi cập nhật dữ liệu: " . $conn->error;
    }
}

// Truy vấn để lấy danh sách các dịch vụ
$sql_select = "SELECT id, ten_dichvu FROM services";
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
    <title>Sửa Dữ Liệu</title>
</head>
<body>
    <h2>Sửa Dữ Liệu</h2>
    <form action="" method="post">
        <label for="service_id">Chọn Dịch Vụ:</label><br>
        <select name="service_id" id="service_id">
            <?php foreach ($services as $service): ?>
                <option value="<?php echo $service['id']; ?>"><?php echo $service['ten_dichvu']; ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <label for="ten_dichvu">Tên Dịch Vụ:</label><br>
        <input type="text" id="ten_dichvu" name="ten_dichvu" value="<?php echo $ten_dichvu; ?>"><br>
        <label for="mota">Mô Tả:</label><br>
        <textarea id="mota" name="mota"><?php echo $mota; ?></textarea><br>
        <label for="gia">Giá:</label><br>
        <input type="text" id="gia" name="gia" value="<?php echo $gia; ?>"><br><br>
        <input type="submit" value="Cập Nhật Dữ Liệu">
    </form>
</body>
</html>
