<?php
header('Content-type:text/html; charset=utf-8');
session_start();
include './parts/pdo_connect.php';

$email = $conn->real_escape_string($_POST['email']);
$password = $conn->real_escape_string($_POST['password']);

$sql = "SELECT * FROM employees WHERE email='$email'";

$result = $conn->query($sql);
if ($result->num_rows == 1) {
  $row = $result->fetch_assoc();

  if ($password === $row['password']) {

    $_SESSION['admin'] = [
      'employee_id' => $row['employee_id'],
      'email' => $row['email'],
      'employee_nickname' => $row['employee_nickname'],
    ];


    header("Location: index_.php");
    exit();
  } else {
    $signinResultText = "密碼錯誤，請重新嘗試。";
  }
} else {
  $signinResultText = "帳號不存在，請聯繫管理員。";
}

$conn->close();
?>
<!-- error Start -->
<div class="container-fluid ">
  <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
    <div class="col-md-6 text-center p-4">
      <i class="bi bi-exclamation-triangle display-1 text-primary"></i>
      <h1 class="mb-4 mt-4"><?php echo $signinResultText ?></h1>
      <a class="btn btn-primary rounded-pill py-3 px-5" href="index.php">重新登入</a>
    </div>
  </div>
</div>
<!-- error End -->


<?php include __DIR__ . '/parts/html-head.php' ?>