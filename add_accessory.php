<?php
require("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Xử lý upload ảnh
    $img_name = $_FILES['img']['name'];
    $img_temp = $_FILES['img']['tmp_name'];
    $img_type = $_FILES['img']['type'];

    // Thư mục lưu trữ ảnh
    $target_dir = "uploads/";
    // Đường dẫn tới file ảnh sau khi upload
    $target_file = $target_dir . basename($img_name);

    // Chỉ cho phép upload file ảnh có định dạng jpg, jpeg, png
    $allowed_types = array('image/jpeg', 'image/jpg', 'image/png');
    if (in_array($img_type, $allowed_types)) {
        // Di chuyển file ảnh tạm thời đến thư mục lưu trữ
        if (move_uploaded_file($img_temp, $target_file)) {
            $sql = "INSERT INTO accessories (ten_phukien, gia, img) VALUES ('$name', '$price', '$target_file')";
            
            if ($conn->query($sql) === TRUE) {
                echo "Phụ kiện đã được thêm thành công";
            } else {
                echo "Lỗi khi thêm phụ kiện: " . $conn->error;
            }
        } else {
            echo "Xin lỗi, có lỗi xảy ra khi tải lên tệp của bạn.";
        }
    } else {
        echo "Xin lỗi, chỉ các tệp JPG, JPEG, PNG được phép.";
    }
}

$conn->close();
?>
<h2>Thêm Phụ Kiện</h2>
<form action="" method="post" enctype="multipart/form-data">
    <label for="name">Tên Phụ Kiện:</label><br>
    <input type="text" id="name" name="name"><br>
    <label for="price">Giá:</label><br>
    <input type="text" id="price" name="price"><br>
    <label for="img">Ảnh:</label><br>
    <input type="file" id="img" name="img"><br><br>
    <input type="submit" value="Thêm Phụ Kiện">
</form>
