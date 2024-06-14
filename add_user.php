<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h2{
            text-align: center;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #FFECA1;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        form {
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Register</h2>
    <form action="" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br>
        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password" id="confirm_password" name="confirm_password"><br><br>
        <input type="submit" value="Register">
        <a href="login.php">Login</a>
    </form>
</div>

<?php
// Kiểm tra xem đã gửi dữ liệu từ form chưa
if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
    // Kết nối đến cơ sở dữ liệu
    require("connect.php");

    // Lấy dữ liệu từ form và loại bỏ các ký tự đặc biệt
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Kiểm tra mật khẩu đã nhập lại có khớp với mật khẩu đã nhập không
    if ($password !== $confirm_password) {
        echo "Mật khẩu nhập lại không khớp. Vui lòng nhập lại.";
    } else {
        // Sử dụng câu lệnh SQL để thêm dữ liệu
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

        // Thực thi truy vấn
        if ($conn->query($sql) === TRUE) {
            echo "Đăng kí tài khoản thành công";
        } else {
            echo "Tài khoản bị trùng lặp hoặc có lỗi xảy ra khi thêm dữ liệu.";
        }
    }

    // Đóng kết nối
    $conn->close();
}
?>

</body>
</html>
