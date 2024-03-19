<?php
//for MySQLi OOP
$conn = new mysqli('localhost', 'root', '', 'mydatabase');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 处理价格筛选参数
$min_price = isset($_GET['min_price']) ? $_GET['min_price'] : 0;
$max_price = isset($_GET['max_price']) ? $_GET['max_price'] : PHP_INT_MAX;

// 准备 SQL 查询
$sql = "SELECT * FROM travel_ WHERE price BETWEEN $min_price AND $max_price";

// 执行查询
$result = $conn->query($sql);

// 显示查询结果
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "	travel_id: " . $row["	travel_id"] . " - logo: " . $row["logo"] . " - title: " . $row["title"] . " - introduce: " . $row["introduce"] . " - days: " . $row["days"] . " - price: " . $row["price"] . " - time: " . $row["time"] . " - airport: " . $row["airport"] . " - seat: " . $row["seat"] . " - number: " . $row["number"] . " - sale: " . $row["sale"] . " - sign_up: " . $row["sign_up"]. "<br>";
    }
} else {
    echo "0 结果";
}

// 关闭数据库连接
$conn->close();
