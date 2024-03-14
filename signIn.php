<?php
header('Content-type:text/html; charset=utf-8');
session_start();
include './parts/pdo_connect.php';

$email = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']);

$sql = "SELECT * FROM employees WHERE email='$email'";
$result = $conn->query($sql);

?>

<?php

if ($result->num_rows == 1) {
  $row = $result->fetch_assoc();

  if ($password === $row['password']) {
    $welcomeMessage = "登入成功，歡迎回來 ";
    $welcomeMessage .= !empty($row['nickname']) ? $row['nickname'] : $row['username'];
    echo $welcomeMessage;
    $_SESSION['employee_id'] = $row['employee_id'];
    header("Location: index_.php");
    exit();
  } else {
    $signinResult = "密碼錯誤，請重新嘗試。";
  }
} else {
  $signinResult = "帳號不存在，請聯繫管理員。";
}

$conn->close();
?>
<!-- 404 Start -->
<div class="container-fluid ">
  <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
    <div class="col-md-6 text-center p-4">
      <i class="bi bi-exclamation-triangle display-1 text-primary"></i>
      <h1 class="mb-4 mt-4"><?php echo $signinResult ?></h1>
      <a class="btn btn-primary rounded-pill py-3 px-5" href="index.php">重新登入</a>
    </div>
  </div>
</div>
<!-- 404 End -->


<?php include __DIR__ . '/parts/html-head.php' ?>