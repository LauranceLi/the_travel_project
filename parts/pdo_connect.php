<?php

$db_host = "127.0.0.1";
$db_user = 'the_travel_project';
$db_pass = ''; # 沒有密碼就留空字串
$db_name = 'the_travel_project'; # 資料庫名稱未定

$dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";

$pdo_options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]; # 可視性佳

$pdo = new PDO($dsn, $db_user, $db_pass);

