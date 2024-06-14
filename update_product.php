<?php

require("connect.php");

$ten_sanpham = $mota = $gia = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_sanpham = $_POST['id_sanpham'];
    $ten_sanpham = $_POST['ten_sanpham'];
    $gia = $_POST['gia'];

    $sql = "UPDATE products SET ten_sanpham='$ten_sanpham', gia='$gia' WHERE id_sanpham = $id_sanpham";
    
    if ($conn->query($sql) === TRUE) {
        echo "Dữ liệu đã được cập nhật thành công";
    } else {
        echo "Lỗi khi cập nhật dữ liệu: " . $conn->error;
    }
}

$sql_select = "SELECT id_sanpham, ten_sanpham FROM products";
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
    <title>Sửa Dữ Liệu Sản Phẩm</title>
</head>
<body>
    <h2>Sửa Dữ Liệu Sản Phẩm</h2>
    <form action="" method="post">
        <label for="id_sanpham">Chọn Sản Phẩm:</label><br>
        <select name="id_sanpham" id="id_sanpham">
            <?php foreach ($products as $product): ?>
                <option value="<?php echo $product['id_sanpham']; ?>"><?php echo $product['ten_sanpham']; ?></option>
            <?php endforeach; ?>
        </select><br><br>
        <label for="ten_sanpham">Tên Sản Phẩm:</label><br>
        <input type="text" id="ten_sanpham" name="ten_sanpham" value="<?php echo $ten_sanpham; ?>"><br>
        <label for="mota">Mô Tả:</label><br>
        <textarea id="mota" name="mota"><?php echo $mota; ?></textarea><br>
        <label for="gia">Giá:</label><br>
        <input type="text" id="gia" name="gia" value="<?php echo $gia; ?>"><br><br>
        <input type="submit" value="Cập Nhật Dữ Liệu">
    </form>
</body>
</html>
