<?php

require("connect.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $service_id = $_POST['service_id'];


    $sql = "DELETE FROM services WHERE id = $service_id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Dữ liệu đã được xóa thành công";
    } else {
        echo "Lỗi khi xóa dữ liệu: " . $conn->error;
    }
}


$sql_select = "SELECT id, ten_dichvu FROM services";
$result = $conn->query($sql_select);
$services = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
}


$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa Dữ Liệu</title>
</head>
<body>
    <h2>Xóa Dữ Liệu</h2>
    <form action="" method="post">
        <label for="service_id">Chọn Dịch Vụ:</label><br>
        <select name="service_id" id="service_id">
            <?php foreach ($services as $service): ?>
                <option value="<?php echo $service['id']; ?>"><?php echo $service['ten_dichvu']; ?></option>
            <?php endforeach; ?>
        </select><br>
        <input type="submit" value="Xóa Dữ Liệu">
    </form>
</body>
</html>
