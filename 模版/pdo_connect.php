<?php

$db_host = "172.23.52.126";
$db_user = 'thirdgroup';
$db_pass = '030303'; 
$db_name = 'the_travel_project'; 

$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";

$pdo_options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]; # 可視性佳

$pdo = new PDO($dsn, $db_user, $db_pass);

$sql = "SELECT * FROM members LIMIT 1"; # 根據自己負責的表單修改
$stmt = $pdo->query($sql);

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC); # PDO::FETCH_ASSOC 可視性佳

header('Content-Type: application/json');

echo json_encode($rows);