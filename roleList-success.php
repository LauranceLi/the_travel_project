<?php
  require __DIR__ . '/parts/pdo_connect.php';
  session_start();
  $title = "歡迎回來";
  $pageName = 'index';
  
?>

<?php include __DIR__. '/parts/html-head.php' ?>
<?php include __DIR__. '/parts/spinner.php' ?>
<?php include __DIR__. '/parts/slidebar.php' ?>
<?php include __DIR__. '/parts/navbar.php' ?>
<!-- error Start -->
<div class="container-fluid ">
  <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
    <div class="col-md-6 text-center p-4">
      <i class="fa-solid fa-circle-check display-1 text-primary"></i>
      <h1 class="mb-4 mt-4">操作成功</h1>
      <p>將在 3 秒後自動跳轉</p>
    </div>
  </div>
</div>
<!-- error End -->



<?php include __DIR__. '/parts/footer.php' ?>
<?php include __DIR__ . '/parts/scripts.php' ?>
<script>
setTimeout(function() {
    window.location.href = "./roleList.php";
}, 3000);
</script>

<?php include __DIR__ . '/parts/html-foot.php' ?>