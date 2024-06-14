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
           
            $sql = "INSERT INTO products (ten_sanpham, gia, img) VALUES ('$name', '$price', '$target_file')";
            
            if ($conn->query($sql) === TRUE) {
                echo "Product added successfully";
            } else {
                echo "Error adding product: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, only JPG, JPEG, PNG files are allowed.";
    }
}

$conn->close();
?>


   <h2>Add Product</h2>
    <form action="" method="post" enctype="multipart/form-data">
        
        <label for="name">Product Name:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="price">Price:</label><br>
        <input type="text" id="price" name="price"><br>
        <label for="img">Image:</label><br>
        <input type="file" id="img" name="img"><br><br>
        <input type="submit" value="Add Product">
    </form>

    
