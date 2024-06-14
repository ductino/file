<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
        }
        header {
            background-image: url('https://th.bing.com/th/id/OIP.mbBC8hBedpzdtPLaSbw2wQHaE7?w=288&h=192&c=7&r=0&o=5&dpr=1.3&pid=1.7');
        background-color: #FFE4E1;
        background-size: cover;
        background-position: center;
        color: #fff;
        padding: 10px;
        text-align: center;
        width: 100%;
        }
        nav {
            background-color: #333;
            color: #fff;
            padding: 20px;
            width: 200px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: width 0.3s ease;
        }
        nav:hover {
            width: 250px;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
        }
        nav ul li {
            margin-bottom: 10px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        nav ul li a:hover {
            background-color: #34495e;
        }
        .sub-menu {
            display: none;
            background-color: black;
            padding: 10px;
            border-radius: 5px;
        }
        .sub-menu a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 5px;
            transition: background-color 0.3s ease;
        }
        .sub-menu a:hover {
            background-color: #34495e;
        }
        /* Hiển thị menu dropdown khi di chuột vào mục danh sách chính */
        nav ul li:hover .sub-menu {
            display: block;
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Page</h1>
    </header>
    <nav>
        <ul>
            <li><a href="#">Quản lý sản phẩm</a>
                <ul class="sub-menu">
                    <li><a href="add_product.php">Thêm sản phẩm</a></li>
                    <li><a href="delete_product">Xóa sản phẩm</a></li>
                    <li><a href="update_product">Sửa sản phẩm</a></li>
                    <li><a href="hienthi_products.php">Danh sách sản phẩm</a></li>
                </ul>
            </li>
            <li><a href="#">Quản lý dịch vụ</a>
                <ul class="sub-menu">
                    <li><a href="add_service.php">Thêm dịch vụ</a></li>
                    <li><a href="delete_service.php">Xóa dịch vụ</a></li>
                    <li><a href="update_service.php">Sửa dịch vụ</a></li>
                    <li><a href="hienthi_service.php">Danh sách dịch vụ</a></li>
                </ul>
            </li>
            <li><a href="#">Quản lý người dùng</a>
                <ul class="sub-menu">
                    <li><a href="#">Thêm người dùng</a></li>
                    <li><a href="#">Xóa người dùng</a></li>
                    <li><a href="#">Sửa người dùng</a></li>
                </ul>
            </li>
            <li><a href="#">Quản lý phụ kiện</a>
                <ul class="sub-menu">
                    <li><a href="add_accessory.php">Thêm phụ kiện</a></li>
                    <li><a href="xoa_accessory.php">Xóa phụ kiện</a></li>
                    <li><a href="update_accessory.php">Sửa dịch vụ</a></li>
                    <li><a href="hienthi_accessory.php">Danh sách phụ kiện</a></li>
                </ul>
            </li>
            <li><a href="login.php">Logout</a></li>
        </ul>
    </nav>
</body>
</html>
