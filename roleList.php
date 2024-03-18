<?php
require __DIR__ . '/parts/pdo_connect.php';
session_start();
$title = "Role List";
$pageName = 'roleList';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
if ($page < 1) {
  header('Location: ?page=1');
  exit;
}
# 每一頁有幾筆
$per_page = 10;

# 計算總筆數
$pages_sql = "SELECT COUNT(1) FROM role_set";
$pages_result = $conn->query($pages_sql)->fetch_assoc();
$total_rows = $pages_result['COUNT(1)'];


$total_pages = ceil($total_rows / $per_page); # 總頁數
$per_page_row = [];
if ($total_rows > 0) {
  if ($page > $total_pages) {
    header('Location: ?page=' . $total_pages);
    exit;
  }
}



$permission_sql =
  sprintf(
    "SELECT *
  FROM permission
  INNER JOIN role_set
  ON role_set.role_id = permission.permission_role_id
  ORDER BY role_id ASC LIMIT %s, %s",
    ($page - 1) * $per_page,
    $per_page
  );

$permission_result = $conn->query($permission_sql);

?>
<?php include __DIR__ . '/parts/html-head.php' ?>
<style>
  table {
    table-layout: fixed;
  }
</style>

<?php include __DIR__ . '/parts/spinner.php' ?>
<?php include __DIR__ . '/parts/slidebar.php' ?>
<?php include __DIR__ . '/parts/navbar.php' ?>
<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
  <div class="row g-4">
    <div class="col-sm-12 col-xl-12">
      <div class="bg-secondary rounded h-100 p-4">
        <div class="roleListTitleBox d-flex justify-content-between">
          <h3 class="mb-3">角色權限一覽</h3>
          <!-- add form start -->
          <button type="button" class="btn btn-outline-info mb-3 " data-bs-toggle="modal" data-bs-target="#staticBackdrop">新增</button>
          <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content bg-secondary border-0">
                <form action="roleList.php" method="post">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">新增角色</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <div class="modal-body ">
                    <h6>角色名稱</h6>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="新建名稱" aria-label="Username" aria-describedby="basic-addon1" name="new_role_name">
                    </div>

                    <div class="permissionBox d-flex justify-content-between">
                      <div class="permissionBoxLeft">
                        <div class="permissionItem m-3 ">
                          <h6>角色設置</h6>
                          <div class="bg-secondary rounded h-100 p-1 d-flex">
                            <div class="form-check form-switch me-4 d-flex align-items-center">
                              <input class="form-check-input me-2" name="isAuthorized[]" value="1" type="checkbox" role="switch" id="roleSetCheckAll" onclick="checkAll(this,'roleSet')">
                              <label class="form-check-label " for="roleSetCheckAll">全選</label>
                            </div>
                            <div class="btn-group" role="group">
                              <input name="roleSet" type="checkbox" class="btn-check" id="viewroleSet" autocomplete="off" checked="true" onclick="allCheck('roleSetCheckAll','roleSet') ">
                              <label class="btn btn-outline-info" for="viewroleSet">檢視</label>

                              <input name="roleSet" type="checkbox" class="btn-check" id="editroleSet" autocomplete="off" onclick="allCheck('roleSetCheckAll','roleSet')">
                              <label class="btn btn-outline-info" for="editroleSet">編輯</label>
                            </div>
                          </div>
                        </div>
                        <div class="permissionItem m-3 ">
                          <h6>員工管理</h6>
                          <div class="bg-secondary rounded h-100 p-1 d-flex">
                            <div class="form-check form-switch me-4 d-flex align-items-center">
                              <input class="form-check-input me-2" name="isAuthorized[]" value="2" type="checkbox" role="switch" id="employeesCheckAll" onclick="checkAll(this,'employee')">
                              <label class="form-check-label " for="employeesCheckAll">全選</label>
                            </div>
                            <div class="btn-group" role="group">
                              <input name="employee" type="checkbox" class="btn-check" id="viewemployee" autocomplete="off" onclick="allCheck('employeesCheckAll','employee')" checked="true">
                              <label class="btn btn-outline-info" for="viewemployee">檢視</label>

                              <input name="employee" type="checkbox" class="btn-check" id="editemployee" autocomplete="off" onclick="allCheck('employeesCheckAll','employee')">
                              <label class="btn btn-outline-info" for="editemployee">編輯</label>

                            </div>
                          </div>
                        </div>
                        <div class="permissionItem m-3 ">
                          <h6>會員管理</h6>
                          <div class="bg-secondary rounded h-100 p-1 d-flex">
                            <div class="form-check form-switch me-4 d-flex align-items-center">
                              <input class="form-check-input me-2" name="isAuthorized[]" value="3" type="checkbox" role="switch" id="membersCheckAll" onclick="checkAll(this,'member')">
                              <label class="form-check-label " for="membersCheckAll">全選</label>
                            </div>
                            <div class="btn-group" role="group">
                              <input name="member" type="checkbox" class="btn-check" id="viewmember" autocomplete="off" onclick="allCheck('membersCheckAll','member')" checked="true">
                              <label class="btn btn-outline-info" for="viewmember">檢視</label>

                              <input name="member" type="checkbox" class="btn-check" id="editmember" autocomplete="off" onclick="allCheck('membersCheckAll','member')">
                              <label class="btn btn-outline-info" for="editmember">編輯</label>

                            </div>
                          </div>
                        </div>
                        <div class="permissionItem m-3 ">
                          <h6>積分管理</h6>
                          <div class="bg-secondary rounded h-100 p-1 d-flex">
                            <div class="form-check form-switch me-4 d-flex align-items-center">
                              <input class="form-check-input me-2" name="isAuthorized[]" value="4" type="checkbox" role="switch" id="pointsCheckAll" onclick="checkAll(this,'point')">
                              <label class="form-check-label " for="pointsCheckAll">全選</label>
                            </div>
                            <div class="btn-group" role="group">
                              <input name="point" type="checkbox" class="btn-check" id="viewpoint" autocomplete="off" onclick="allCheck('pointsCheckAll','point')" checked="true">
                              <label class="btn btn-outline-info" for="viewpoint">檢視</label>

                              <input name="point" type="checkbox" class="btn-check" id="editpoint" autocomplete="off" onclick="allCheck('pointsCheckAll','point')">
                              <label class="btn btn-outline-info" for="editpoint">編輯</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="permissionBoxRight">
                        <div class="permissionItem m-3 ">

                          <h6>套裝行程管理</h6>
                          <div class="bg-secondary rounded h-100 p-1 d-flex">
                            <div class="form-check form-switch me-4 d-flex align-items-center">
                              <input class="form-check-input me-2" name="isAuthorized[]" value="5" type="checkbox" role="switch" id="itineraryCheckAll" onclick="checkAll(this,'itinerary')">
                              <label class="form-check-label " for="itineraryCheckAll">全選</label>
                            </div>
                            <div class="btn-group" role="group">
                              <input name="itinerary" type="checkbox" class="btn-check" id="viewitinerary" autocomplete="off" onclick="allCheck('itineraryCheckAll','itinerary')" checked="true">
                              <label class="btn btn-outline-info" for="viewitinerary">檢視</label>

                              <input name="itinerary" type="checkbox" class="btn-check" id="edititinerary" autocomplete="off" onclick="allCheck('itineraryCheckAll','itinerary')">
                              <label class="btn btn-outline-info" for="edititinerary">編輯</label>
                            </div>
                          </div>
                        </div>
                        <div class="permissionItem m-3">
                          <h6>訂單管理</h6>
                          <div class="bg-secondary rounded h-100 p-1 d-flex">
                            <div class="form-check form-switch me-4 d-flex align-items-center">
                              <input class="form-check-input me-2" name="isAuthorized[]" value="6" type="checkbox" role="switch" id="ordersCheckAll" onclick="checkAll(this,'order')">
                              <label class="form-check-label " for="ordersCheckAll">全選</label>
                            </div>
                            <div class="btn-group" role="group">
                              <input name="order" type="checkbox" class="btn-check" id="vieworder" autocomplete="off" onclick="allCheck('ordersCheckAll','order')" checked="true">
                              <label class="btn btn-outline-info" for="vieworder">檢視</label>

                              <input name="order" type="checkbox" class="btn-check" id="editorder" autocomplete="off" onclick="allCheck('ordersCheckAll','order')">
                              <label class="btn btn-outline-info" for="editorder">編輯</label>
                            </div>
                          </div>
                        </div>
                        <div class="permissionItem m-3">
                          <h6>商品上架管理</h6>
                          <div class="bg-secondary rounded h-100 p-1 d-flex">
                            <div class="form-check form-switch me-4 d-flex align-items-center">
                              <input class="form-check-input me-2" name="isAuthorized[]" value="7" type="checkbox" role="switch" id="productsCheckAll" onclick="checkAll(this,'product')">
                              <label class="form-check-label " for="productsCheckAll">全選</label>
                            </div>
                            <div class="btn-group" role="group">
                              <input name="product" type="checkbox" class="btn-check" id="viewproduct" autocomplete="off" checked="true" onclick="allCheck('productsCheckAll','product')">
                              <label class="btn btn-outline-info" for="viewproduct">檢視</label>

                              <input name="product" type="checkbox" class="btn-check" id="editproduct" autocomplete="off" onclick="allCheck('productsCheckAll','product')">
                              <label class="btn btn-outline-info" for="editproduct">編輯</label>
                            </div>
                          </div>
                        </div>
                        <div class="permissionItem m-3">
                          <h6>表單管理</h6>
                          <div class="bg-secondary rounded h-100 p-1 d-flex">
                            <div class="form-check form-switch me-4 d-flex align-items-center">
                              <input class="form-check-input me-2" name="isAuthorized[]" value="8" type="checkbox" role="switch" id="formCheckAll" onclick="checkAll(this,'form')">
                              <label class="form-check-label " for="formCheckAll">全選</label>
                            </div>
                            <div class="btn-group" role="group">
                              <input name="form" type="checkbox" class="btn-check" id="viewform" autocomplete="off" onclick="allCheck('formCheckAll','form')" checked="true">
                              <label class="btn btn-outline-info" for="viewform">檢視</label>

                              <input name="form" type="checkbox" class="btn-check" id="editform" autocomplete="off" onclick="allCheck('formCheckAll','form')">
                              <label class="btn btn-outline-info" for="editform">編輯</label>

                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-floating m-3">
                        <h6>相關描述</h6>
                        <textarea class="form-control p-2" name="new_role_desc" id="new_role_desc" style="min-height: 91%"></textarea>
                        <label for="new_role_desc"></label>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-outline-info">新增</button>
                  </div>
                </form>
                <?php
                // print_r($_POST);
                if (!empty($_POST)) {
                  $the_employee = $_SESSION['admin']['employee_id'];
                  $new_role_sql = "INSERT INTO `role_set`(`role_name`, `description`, `created_at`, `employee_id`) VALUES ('" . $_POST['new_role_name'] . "','" . $_POST['new_role_desc'] . "',NOW(),'$the_employee')";
                  $new_role_result = $conn->query($new_role_sql);

                  $new_role_row = $conn->query("SELECT role_id FROM role_set order by created_at desc limit 1")->fetch_assoc();

                  $new_role_id = $new_role_row['role_id'];
                  //新增逻辑

                  $isAuthorized = isset($_POST['isAuthorized']) ? $_POST['isAuthorized'] : [];
                  $roleSetAuthorized = in_array(1, $isAuthorized) ? 1 : 0;
                  $employeesAuthorized = in_array(2, $isAuthorized) ? 1 : 0;
                  $membersAuthorized = in_array(3, $isAuthorized) ? 1 : 0;
                  $pointsAuthorized = in_array(4, $isAuthorized) ? 1 : 0;
                  $itineraryAuthorized = in_array(5, $isAuthorized) ? 1 : 0;
                  $ordersAuthorized = in_array(6, $isAuthorized) ? 1 : 0;
                  $productsAuthorized = in_array(7, $isAuthorized) ? 1 : 0;
                  $formAuthorized = in_array(8, $isAuthorized) ? 1 : 0;

                  $isAuthorized_sql =
                    "INSERT INTO `permission`(`permission_role_id`, `role_set`, `employees`, `members`, `points`, `itinerary`, `orders`, `products`, `form`)VALUES ($new_role_id,$roleSetAuthorized,$employeesAuthorized,$membersAuthorized,$pointsAuthorized,$itineraryAuthorized,$ordersAuthorized,$productsAuthorized,$formAuthorized)";

                  $isAuthorized_sql_result = $conn->query($isAuthorized_sql);
                  //執行語法，透過 PDO 物件導向到 query
                  header("location:roleList.php");
                }
                ?>
              </div>
            </div>
          </div>
          <!-- add form end -->
        </div>

        <div class="descript">
          <p>說明：<i class="fa-solid fa-pen-to-square me-1"></i>可供編輯、<i class="fa-solid fa-eye me-1"></i>僅供檢視</p>
        </div>
        <!-- Role List Start -->
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col" class="text-center">角色名稱</th>
              <th scope="col" class="text-center">角色權限管理</th>
              <th scope="col" class="text-center">員工管理</th>
              <th scope="col" class="text-center">會員管理</th>
              <th scope="col" class="text-center">積分管理</th>
              <th scope="col" class="text-center">套裝行程管理</th>
              <th scope="col" class="text-center">訂單管理</th>
              <th scope="col" class="text-center">商品上架管理</th>
              <th scope="col" class="text-center">表單管理</th>
              <th scope="col" class="text-center">編輯
              </th>
              <th scope="col" class="text-center">刪除</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($permission_result as $r) : ?>
              <tr>
                <td class="text-center"><?= $r['role_name'] ?></td>
                <td class="text-center">
                  <?php
                  if ($r['role_set']) {
                    echo '<i class="fa-solid fa-pen-to-square"></i>';
                  } else {
                    echo '<i class="fa-solid fa-eye"></i>';
                  }
                  ?>
                </td>
                <td class="text-center">
                  <?php
                  if ($r['employees']) {
                    echo '<i class="fa-solid fa-pen-to-square"></i>';
                  } else {
                    echo '<i class="fa-solid fa-eye"></i>';
                  }
                  ?>
                </td>
                <td class="text-center">
                  <?php
                  if ($r['members']) {
                    echo '<i class="fa-solid fa-pen-to-square"></i>';
                  } else {
                    echo '<i class="fa-solid fa-eye"></i>';
                  }
                  ?>
                </td>
                <td class="text-center">
                  <?php
                  if ($r['points']) {
                    echo '<i class="fa-solid fa-pen-to-square"></i>';
                  } else {
                    echo '<i class="fa-solid fa-eye"></i>';
                  }
                  ?>
                </td>
                <td class="text-center">
                  <?php
                  if ($r['itinerary']) {
                    echo '<i class="fa-solid fa-pen-to-square"></i>';
                  } else {
                    echo '<i class="fa-solid fa-eye"></i>';
                  }
                  ?>
                </td>
                <td class="text-center">
                  <?php
                  if ($r['orders']) {
                    echo '<i class="fa-solid fa-pen-to-square"></i>';
                  } else {
                    echo '<i class="fa-solid fa-eye"></i>';
                  }
                  ?>
                </td>
                <td class="text-center">
                  <?php
                  if ($r['products']) {
                    echo '<i class="fa-solid fa-pen-to-square"></i>';
                  } else {
                    echo '<i class="fa-solid fa-eye"></i>';
                  }
                  ?>
                </td>
                <td class="text-center">
                  <?php
                  if ($r['form']) {
                    echo '<i class="fa-solid fa-pen-to-square"></i>';
                  } else {
                    echo '<i class="fa-solid fa-eye"></i>';
                  }
                  ?>
                </td>
                <td class="text-center">
                  <a href="javascript: deleteOne(<?= $r['role_id'] ?>)" class="vstack">
                    <i class="fa-solid fa-pen-to-square"></i>
                  </a>
                </td>
                <!-- edit form start -->
                <button type="button" class="btn btn-outline-info mb-3 " data-bs-toggle="modal" data-bs-target="#staticBackdrop">新增</button>
                <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content bg-secondary border-0">
                      <form action="roleList.php" method="post">
                        <div class="modal-header">
                          <h5 class="modal-title" id="staticBackdropLabel">新增角色</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body ">
                          <h6>角色名稱</h6>
                          <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="新建名稱" aria-label="Username" aria-describedby="basic-addon1" name="new_role_name">
                          </div>

                          <div class="permissionBox d-flex justify-content-between">
                            <div class="permissionBoxLeft">
                              <div class="permissionItem m-3 ">
                                <h6>角色設置</h6>
                                <div class="bg-secondary rounded h-100 p-1 d-flex">
                                  <div class="form-check form-switch me-4 d-flex align-items-center">
                                    <input class="form-check-input me-2" name="isAuthorized[]" value="1" type="checkbox" role="switch" id="roleSetCheckAll" onclick="checkAll(this,'roleSet')">
                                    <label class="form-check-label " for="roleSetCheckAll">全選</label>
                                  </div>
                                  <div class="btn-group" role="group">
                                    <input name="roleSet" type="checkbox" class="btn-check" id="viewroleSet" autocomplete="off" checked="true" onclick="allCheck('roleSetCheckAll','roleSet') ">
                                    <label class="btn btn-outline-info" for="viewroleSet">檢視</label>

                                    <input name="roleSet" type="checkbox" class="btn-check" id="editroleSet" autocomplete="off" onclick="allCheck('roleSetCheckAll','roleSet')">
                                    <label class="btn btn-outline-info" for="editroleSet">編輯</label>
                                  </div>
                                </div>
                              </div>
                              <div class="permissionItem m-3 ">
                                <h6>員工管理</h6>
                                <div class="bg-secondary rounded h-100 p-1 d-flex">
                                  <div class="form-check form-switch me-4 d-flex align-items-center">
                                    <input class="form-check-input me-2" name="isAuthorized[]" value="2" type="checkbox" role="switch" id="employeesCheckAll" onclick="checkAll(this,'employee')">
                                    <label class="form-check-label " for="employeesCheckAll">全選</label>
                                  </div>
                                  <div class="btn-group" role="group">
                                    <input name="employee" type="checkbox" class="btn-check" id="viewemployee" autocomplete="off" onclick="allCheck('employeesCheckAll','employee')" checked="true">
                                    <label class="btn btn-outline-info" for="viewemployee">檢視</label>

                                    <input name="employee" type="checkbox" class="btn-check" id="editemployee" autocomplete="off" onclick="allCheck('employeesCheckAll','employee')">
                                    <label class="btn btn-outline-info" for="editemployee">編輯</label>

                                  </div>
                                </div>
                              </div>
                              <div class="permissionItem m-3 ">
                                <h6>會員管理</h6>
                                <div class="bg-secondary rounded h-100 p-1 d-flex">
                                  <div class="form-check form-switch me-4 d-flex align-items-center">
                                    <input class="form-check-input me-2" name="isAuthorized[]" value="3" type="checkbox" role="switch" id="membersCheckAll" onclick="checkAll(this,'member')">
                                    <label class="form-check-label " for="membersCheckAll">全選</label>
                                  </div>
                                  <div class="btn-group" role="group">
                                    <input name="member" type="checkbox" class="btn-check" id="viewmember" autocomplete="off" onclick="allCheck('membersCheckAll','member')" checked="true">
                                    <label class="btn btn-outline-info" for="viewmember">檢視</label>

                                    <input name="member" type="checkbox" class="btn-check" id="editmember" autocomplete="off" onclick="allCheck('membersCheckAll','member')">
                                    <label class="btn btn-outline-info" for="editmember">編輯</label>

                                  </div>
                                </div>
                              </div>
                              <div class="permissionItem m-3 ">
                                <h6>積分管理</h6>
                                <div class="bg-secondary rounded h-100 p-1 d-flex">
                                  <div class="form-check form-switch me-4 d-flex align-items-center">
                                    <input class="form-check-input me-2" name="isAuthorized[]" value="4" type="checkbox" role="switch" id="pointsCheckAll" onclick="checkAll(this,'point')">
                                    <label class="form-check-label " for="pointsCheckAll">全選</label>
                                  </div>
                                  <div class="btn-group" role="group">
                                    <input name="point" type="checkbox" class="btn-check" id="viewpoint" autocomplete="off" onclick="allCheck('pointsCheckAll','point')" checked="true">
                                    <label class="btn btn-outline-info" for="viewpoint">檢視</label>

                                    <input name="point" type="checkbox" class="btn-check" id="editpoint" autocomplete="off" onclick="allCheck('pointsCheckAll','point')">
                                    <label class="btn btn-outline-info" for="editpoint">編輯</label>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="permissionBoxRight">
                              <div class="permissionItem m-3 ">

                                <h6>套裝行程管理</h6>
                                <div class="bg-secondary rounded h-100 p-1 d-flex">
                                  <div class="form-check form-switch me-4 d-flex align-items-center">
                                    <input class="form-check-input me-2" name="isAuthorized[]" value="5" type="checkbox" role="switch" id="itineraryCheckAll" onclick="checkAll(this,'itinerary')">
                                    <label class="form-check-label " for="itineraryCheckAll">全選</label>
                                  </div>
                                  <div class="btn-group" role="group">
                                    <input name="itinerary" type="checkbox" class="btn-check" id="viewitinerary" autocomplete="off" onclick="allCheck('itineraryCheckAll','itinerary')" checked="true">
                                    <label class="btn btn-outline-info" for="viewitinerary">檢視</label>

                                    <input name="itinerary" type="checkbox" class="btn-check" id="edititinerary" autocomplete="off" onclick="allCheck('itineraryCheckAll','itinerary')">
                                    <label class="btn btn-outline-info" for="edititinerary">編輯</label>
                                  </div>
                                </div>
                              </div>
                              <div class="permissionItem m-3">
                                <h6>訂單管理</h6>
                                <div class="bg-secondary rounded h-100 p-1 d-flex">
                                  <div class="form-check form-switch me-4 d-flex align-items-center">
                                    <input class="form-check-input me-2" name="isAuthorized[]" value="6" type="checkbox" role="switch" id="ordersCheckAll" onclick="checkAll(this,'order')">
                                    <label class="form-check-label " for="ordersCheckAll">全選</label>
                                  </div>
                                  <div class="btn-group" role="group">
                                    <input name="order" type="checkbox" class="btn-check" id="vieworder" autocomplete="off" onclick="allCheck('ordersCheckAll','order')" checked="true">
                                    <label class="btn btn-outline-info" for="vieworder">檢視</label>

                                    <input name="order" type="checkbox" class="btn-check" id="editorder" autocomplete="off" onclick="allCheck('ordersCheckAll','order')">
                                    <label class="btn btn-outline-info" for="editorder">編輯</label>
                                  </div>
                                </div>
                              </div>
                              <div class="permissionItem m-3">
                                <h6>商品上架管理</h6>
                                <div class="bg-secondary rounded h-100 p-1 d-flex">
                                  <div class="form-check form-switch me-4 d-flex align-items-center">
                                    <input class="form-check-input me-2" name="isAuthorized[]" value="7" type="checkbox" role="switch" id="productsCheckAll" onclick="checkAll(this,'product')">
                                    <label class="form-check-label " for="productsCheckAll">全選</label>
                                  </div>
                                  <div class="btn-group" role="group">
                                    <input name="product" type="checkbox" class="btn-check" id="viewproduct" autocomplete="off" checked="true" onclick="allCheck('productsCheckAll','product')">
                                    <label class="btn btn-outline-info" for="viewproduct">檢視</label>

                                    <input name="product" type="checkbox" class="btn-check" id="editproduct" autocomplete="off" onclick="allCheck('productsCheckAll','product')">
                                    <label class="btn btn-outline-info" for="editproduct">編輯</label>
                                  </div>
                                </div>
                              </div>
                              <div class="permissionItem m-3">
                                <h6>表單管理</h6>
                                <div class="bg-secondary rounded h-100 p-1 d-flex">
                                  <div class="form-check form-switch me-4 d-flex align-items-center">
                                    <input class="form-check-input me-2" name="isAuthorized[]" value="8" type="checkbox" role="switch" id="formCheckAll" onclick="checkAll(this,'form')">
                                    <label class="form-check-label " for="formCheckAll">全選</label>
                                  </div>
                                  <div class="btn-group" role="group">
                                    <input name="form" type="checkbox" class="btn-check" id="viewform" autocomplete="off" onclick="allCheck('formCheckAll','form')" checked="true">
                                    <label class="btn btn-outline-info" for="viewform">檢視</label>

                                    <input name="form" type="checkbox" class="btn-check" id="editform" autocomplete="off" onclick="allCheck('formCheckAll','form')">
                                    <label class="btn btn-outline-info" for="editform">編輯</label>

                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="form-floating m-3">
                              <h6>相關描述</h6>
                              <textarea class="form-control p-2" name="new_role_desc" id="new_role_desc" style="min-height: 91%"></textarea>
                              <label for="new_role_desc"></label>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                          <button type="submit" class="btn btn-outline-info">新增</button>
                        </div>
                      </form>
                      <?php
                      // print_r($_POST);
                      if (!empty($_POST)) {
                        $the_employee = $_SESSION['admin']['employee_id'];
                        $new_role_sql = "INSERT INTO `role_set`(`role_name`, `description`, `created_at`, `employee_id`) VALUES ('" . $_POST['new_role_name'] . "','" . $_POST['new_role_desc'] . "',NOW(),'$the_employee')";
                        $new_role_result = $conn->query($new_role_sql);

                        $new_role_row = $conn->query("SELECT role_id FROM role_set order by created_at desc limit 1")->fetch_assoc();

                        $new_role_id = $new_role_row['role_id'];
                        //新增逻辑

                        $isAuthorized = isset($_POST['isAuthorized']) ? $_POST['isAuthorized'] : [];
                        $roleSetAuthorized = in_array(1, $isAuthorized) ? 1 : 0;
                        $employeesAuthorized = in_array(2, $isAuthorized) ? 1 : 0;
                        $membersAuthorized = in_array(3, $isAuthorized) ? 1 : 0;
                        $pointsAuthorized = in_array(4, $isAuthorized) ? 1 : 0;
                        $itineraryAuthorized = in_array(5, $isAuthorized) ? 1 : 0;
                        $ordersAuthorized = in_array(6, $isAuthorized) ? 1 : 0;
                        $productsAuthorized = in_array(7, $isAuthorized) ? 1 : 0;
                        $formAuthorized = in_array(8, $isAuthorized) ? 1 : 0;

                        $isAuthorized_sql =
                          "INSERT INTO `permission`(`permission_role_id`, `role_set`, `employees`, `members`, `points`, `itinerary`, `orders`, `products`, `form`)VALUES ($new_role_id,$roleSetAuthorized,$employeesAuthorized,$membersAuthorized,$pointsAuthorized,$itineraryAuthorized,$ordersAuthorized,$productsAuthorized,$formAuthorized)";

                        $isAuthorized_sql_result = $conn->query($isAuthorized_sql);
                        //執行語法，透過 PDO 物件導向到 query
                        header("location:roleList.php");
                      }
                      ?>
                    </div>
                  </div>
                </div>
                <!-- edit form end -->
                <td class="d-flex justify-content-center">
                  <a href="javascript: deleteOne(<?= $r['role_id'] ?>)" class="vstack">
                    <i class="fa-solid fa-trash text-danger"></i>
                  </a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        <!-- Role List end -->
        <!-- 頁碼條 Start -->
        <nav aria-label="First group">
          <ul class="pagination">
            <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
              <a class="page-link" href="?page=<?= 1 ?>">
                <i class="fa-solid fa-angles-left"></i>
              </a>
            </li>
            <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
              <a class="page-link" href="?page=<?= $page - 1 ?>">
                <i class="fa-solid fa-angle-left"></i>
              </a>
            </li>
            <!-- 頁碼條 end -->

            <!-- 限制頁碼條 -->
            <?php for ($i = $page - 5; $i <= $page + 5; $i++) : ?>
              <?php if ($i >= 1 and $i <= $total_pages) : ?>
                <li class="page-item <?= $i != $page ?: 'active' ?>">
                  <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
              <?php endif ?>
            <?php endfor ?>
            <li class="page-item <?= $page == $total_pages ? 'disabled' : '' ?>">
              <a class="page-link" href="?page=<?= $page + 1 ?>">
                <i class="fa-solid fa-angle-right"></i>
              </a>
            </li>
            <li class="page-item <?= $page == $total_pages ? 'disabled' : '' ?>">
              <a class="page-link" href="?page=<?= $total_pages ?>">
                <i class="fa-solid fa-angles-right"></i>
              </a>
            </li>
          </ul>
        </nav>
        <!-- 頁碼條 end -->
      </div>
    </div>
  </div>
</div>
<!-- Table End -->

<?php include __DIR__ . '/parts/footer.php' ?>
<?php include __DIR__ . '/parts/scripts.php' ?>
<script>
  const checkAll = (CheckAll, setGroup) => {
    let checkboxs = document.getElementsByName(setGroup);
    for (let i = 0; i < checkboxs.length; i++) {

      checkboxs[i].checked = CheckAll.checked;
    }
  }

  const allCheck = (checkAll, setGroup) => {
    let checkboxs = document.getElementsByName(setGroup);
    let checkswitch = document.getElementById(checkAll);
    if (checkboxs[0].checked && checkboxs[1].checked) {
      return checkswitch.checked = true;
    } else {
      return checkswitch.checked = false;
    }
  }

  const deleteOne = (role_id) => {
    if (confirm(`是否要刪除編號為${role_id}的項目`)) {
      location.href = `roleList-delete.php?role_id=${role_id}`;
    } else {
      return
    }
  }
</script>

<?php include __DIR__ . '/parts/html-foot.php' ?>