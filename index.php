<?php
  require __DIR__ . '/parts/pdo_connect.php';
  $title = 'Sign In';
  $pageName = 'Sign_in';
  if (isset($_SESSION['admin'])) {
    header('Location: index_.php');
    exit;
  }

?>
<?php include __DIR__. '/parts/html-head.php' ?>
<?php include __DIR__. '/parts/spinner.php' ?>


        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
                                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>DarkPan</h3>
                            </a>
                            <h3>Sign In</h3>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-4">

                            <a href="">Forgot Password</a>
                        </div>
                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>
    <script>
  const {
    email: emailField,
    password:passwordField
  } = document.form1;

  function validateEmail(email) {
    const re =
      /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
  }



  function sendData(e) {
    // 欄位的外觀要回復原來的狀態

    emailField.style.border = "1px solid #CCC";
    emailField.nextElementSibling.innerHTML = '';



    e.preventDefault(); // 不要讓有外觀的表單以傳統的方式送出

    let isPass = true; // 有沒有通過檢查, 預設值為 true

    // TODO: 檢查資料的格式

    // email 若有填才檢查格式, 沒填不檢查格式
    if (emailField.value && !validateEmail(emailField.value)) {
      isPass = false;
      emailField.style.border = "2px solid red";
      emailField.nextElementSibling.innerHTML = '請輸入正確的 Email';
    }



    // 如果欄位都有通過檢查, 才要發 AJAX
    if (isPass) {
      const fd = new FormData(document.form1); // 看成沒有外觀的表單

      fetch('login-api.php', {
          method: 'POST',
          body: fd
        })
        .then(r => r.json())
        .then(result => {
          console.log(result);
          if (result.success) {
            location.href = 'index_.php';
          } else {
            failureModal.show();
          }
        })
        .catch(ex => {
          console.log(ex);
        })
    }


  }
  const failureModal = new bootstrap.Modal('#failureModal');

</script>
<?php include __DIR__. '/parts/scripts.php' ?>