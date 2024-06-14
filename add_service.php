<?php
// Kết nối đến cơ sở dữ liệu
require("connect.php");

// Kiểm tra xem có dữ liệu được gửi từ form không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $ten_dichvu = $_POST['ten_dichvu'];
    $mota = $_POST['mota'];
    $gia = $_POST['gia'];

    // Thực hiện upload ảnh và thêm dữ liệu vào cơ sở dữ liệu
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["img_file"]["name"]); // Đường dẫn tới file ảnh sau khi upload

    // Lấy thông tin về file ảnh
    $img_name = $_FILES["img_file"]["name"];
    $img_temp = $_FILES["img_file"]["tmp_name"];
    $img_type = $_FILES["img_file"]["type"];

    // Chỉ cho phép upload file ảnh có định dạng jpg, jpeg, png
    $allowed_types = array('image/jpeg', 'image/jpg', 'image/png');
    if (in_array($img_type, $allowed_types)) {
        // Di chuyển file ảnh tạm thời đến thư mục lưu trữ
        if (move_uploaded_file($img_temp, $target_file)) {
            // Thêm dữ liệu vào bảng dịch vụ sau khi upload ảnh thành công
            $sql = "INSERT INTO services (ten_dichvu, mota, gia, img) VALUES ('$ten_dichvu', '$mota', '$gia', '$target_file')";
            
            if ($conn->query($sql) === TRUE) {
                echo "Dịch vụ đã được thêm thành công";
            } else {
                echo "Lỗi khi thêm dịch vụ: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, only JPG, JPEG, PNG files are allowed.";
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
    <title>Thêm Dịch Vụ</title>
</head>
<body>
    <h2>Thêm Dịch Vụ</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="ten_dichvu">Tên Dịch Vụ:</label><br>
        <input type="text" id="ten_dichvu" name="ten_dichvu"><br>
        <label for="mota">Mô Tả:</label><br>
        <textarea id="mota" name="mota"></textarea><br>
        <label for="gia">Giá:</label><br>
        <input type="text" id="gia" name="gia"><br>
        <label for="img_file">Chọn ảnh:</label><br>
        <input type="file" id="img_file" name="img_file"><br>
        <input type="submit" value="Thêm Dịch Vụ">
    </form>
</body>
</html>