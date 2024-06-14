<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="home.css">
    <style>
        .search-hide {
            display: none;
        }
        
        .search form {
            display: flex;
            align-items: center;
            margin-top: 30px;
        }
        
        .search input[type="text"] {
            width: 500px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px 0 0 5px;
            font-size: 16px;
        }
        
        .search button {
            padding: 8px 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            font-size: 16px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#searchForm').on('submit', function(e) {
                e.preventDefault(); 
                search();
            });

            function search() {
                var searchTerm = $('#searchInput').val().trim(); 
                if (searchTerm === '') {
                    alert('Please enter a search term');
                    return;
                }
                $.ajax({
                    url: 'search.php',
                    method: 'POST',
                    data: {query: searchTerm},
                    success: function(response) {
                        $('#searchResults').html(response); // Display search results
                        $('.abc').addClass('search-hide'); // Hide the abc div
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', status, error);
                        alert('An error occurred while processing your request. Please try again later.');
                    }
                });
            }
        });
    </script>
</head>
<body>
    <div class="all">
        <div id="header">  
            <div>
                <img src="https://sgweb.vn/wp-content/uploads/2022/12/929214320db3b555561658be08cc399f.jpg" alt="Pet Shop Logo" style="width:80px;height:80px;margin-left:30px;margin-top:10px">
            </div> 
            <nav class="search">
                <form id="searchForm">
                    <input type="text" id="searchInput" placeholder="Search">
                    <button id="searchButton" type="submit">Search</button>
                </form>
            </nav>
            <div class="login">
                <a href="hienthi_cart.php"><img src="cart.png" alt="Shopping Cart" style="width:40px;height:40px"></a>
                <a href="login.php"><img src="user.png" alt="User" style="width:40px;height:40px"></a>
            </div>
        </div>

        <div class="abc">
            <div class="menu">
                <ul>
                    <li><a href="#">Sản phẩm dành cho thú cưng</a></li>
                    <li><a href="#">Dịch vụ chăm sóc thú cưng</a></li>
                    <li><a href="#">Phụ kiện dành cho thú cưng</a></li>
                </ul>
            </div>
            <div class="store-image">
                <img src="https://chophukienpet.com/wp-content/uploads/2023/03/cua-hang-thu-cung.jpg" alt="Pet Store" style="width:100%;height:100%;border-radius: 10px;">
            </div>
            <div class="banners">
                <img src="https://azpet.com.vn/wp-content/uploads/2022/03/banner-desktop-1.jpg" alt="Banner 1" style="width:100%;border-radius: 10px;">
                <img src="https://azpet.com.vn/wp-content/uploads/2022/03/banner-desktop-2.jpg" alt="Banner 2" style="width:100%;border-radius: 10px;">
            </div>
        </div>

        <div id="searchResults"></div>
        
        <div class="container">
    <h1>Sản phẩm nổi bật</h1>
    <div class="products">
        <?php
        require("connect.php");

        $sql = "SELECT * FROM products LIMIT 4";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<img src='" . $row["img"] . "' alt='" . $row["ten_sanpham"] . "'>";
                echo "<h2>" . $row["ten_sanpham"] . "</h2>";
                echo "<p>Giá: $" . $row["gia"] . "</p>";
                echo "<form class='add-to-cart-form' action='cart.php' method='post'>";
                echo "<input type='hidden' name='id' value='" . $row["id_sanpham"] . "'>";
                echo "<input type='hidden' name='type' value='product'>";
                echo "<input type='number' name='quantity' placeholder='số lượng' min='1'>";
                echo "<button type='submit'>Thêm vào giỏ hàng</button>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "Không có sản phẩm nào.";
        }
        ?>
    </div>
</div>

<div class="container">
    <h1>Phụ kiện nổi bật</h1>
    <div class="products">
        <?php
        $sql = "SELECT * FROM accessories LIMIT 4";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<img src='" . $row["img"] . "' alt='" . $row["ten_phukien"] . "'>";
                echo "<h2>" . $row["ten_phukien"] . "</h2>";
                echo "<p>Giá: $" . $row["gia"] . "</p>";
                echo "<form class='add-to-cart-form' action='cart.php' method='post'>";
                echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                echo "<input type='hidden' name='type' value='accessory'>";
                echo "<input type='number' name='quantity' placeholder='số lượng' min='1'>";
                echo "<button type='submit'>Thêm vào giỏ hàng</button>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "Không có phụ kiện nào.";
        }
        ?>
    </div>
</div>

<div class="container">
    <h1>Dịch vụ nổi bật</h1>
    <div class="products">
        <?php
        $sql = "SELECT * FROM services LIMIT 4";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<img src='" . $row["img"] . "' alt='" . $row["ten_dichvu"] . "'>";
                echo "<h2>" . $row["ten_dichvu"] . "</h2>";
                echo "<p>Giá: $" . $row["gia"] . "</p>";
                echo "<form class='add-to-cart-form' action='cart.php' method='post'>";
                echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                echo "<input type='hidden' name='type' value='service'>";
                echo "<input type='number' name='quantity' placeholder='Số lượng' min='1'>";
                echo "<button type='submit' class='btn-add-to-cart'>Thêm vào giỏ</button>";
                echo "</form>";
                echo "</div>";
            }
        } else {
            echo "Không có dịch vụ nào.";
        }
        ?>
    </div>
</div>

    <div id="footer">
        <div>
            <h3>Liên Hệ Shop</h3>
            <p>Trụ Sở: Hà Nội</p>
            <p>Hotline: 0888 08 3388</p>
            <p>Website: <a href="https://azpet.com.vn">azpet.com.vn</a></p>
            <p>Email: <a href
