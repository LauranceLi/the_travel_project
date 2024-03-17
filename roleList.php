<?php
require __DIR__ . '/parts/pdo_connect.php';
session_start();
$title = "Role List";
$pageName = 'roleList';


$permission_sql =
  "SELECT *
  FROM permission
  INNER JOIN role_set
  ON role_set.role_id = permission.permission_role_id";
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

          <button type="button" class="btn btn-outline-info mb-3 " data-bs-toggle="modal" data-bs-target="#staticBackdrop">新增</button>

          <!-- add form start -->
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
                              <input class="form-check-input me-2" name="isAuthorized[]" value=1 type="checkbox" role="switch" id="roleSetCheckAll" onclick="checkAll(this,'roleSet')">
                              <label class="form-check-label " for="roleSetCheckAll">全選</label>
                            </div>
                            <div class="btn-group" role="group">
                              <input name="roleSet" type="checkbox" class="btn-check" id="viewroleSet" autocomplete="off"  checked="true" onclick="allCheck('roleSetCheckAll','roleSet') ">
                              <label class="btn btn-outline-info" for="viewroleSet" >檢視</label>
                        
                              <input name="roleSet" type="checkbox" class="btn-check" id="editroleSet" autocomplete="off" onclick="allCheck('roleSetCheckAll','roleSet')">
                              <label class="btn btn-outline-info" for="editroleSet">編輯</label>
                        
                        
                            </div>
                          </div>
                        </div>
                        <div class="permissionItem m-3 ">
                          <h6>員工管理</h6>
                          <div class="bg-secondary rounded h-100 p-1 d-flex">
                            <div class="form-check form-switch me-4 d-flex align-items-center">
                              <input class="form-check-input me-2" name="isAuthorized[]" value=1 type="checkbox" role="switch" id="employeeCheckAll" onclick="checkAll(this,'employee')">
                              <label class="form-check-label " for="employeeCheckAll">全選</label>
                            </div>
                            <div class="btn-group" role="group">
                              <input name="employee" type="checkbox" class="btn-check" id="viewemployee" autocomplete="off" onclick="allCheck('employeeCheckAll','employee')" checked="true">
                              <label class="btn btn-outline-info" for="viewemployee">檢視</label>
                        
                              <input name="employee" type="checkbox" class="btn-check" id="editemployee" autocomplete="off" onclick="allCheck('employeeCheckAll','employee')">
                              <label class="btn btn-outline-info" for="editemployee">編輯</label>
                        
                            </div>
                          </div>
                        </div>
                        <div class="permissionItem m-3 ">
                          <h6>會員管理</h6>
                          <div class="bg-secondary rounded h-100 p-1 d-flex">
                            <div class="form-check form-switch me-4 d-flex align-items-center">
                              <input class="form-check-input me-2" name="isAuthorized[]" value=1 type="checkbox" role="switch" id="memberCheckAll" onclick="checkAll(this,'member')">
                              <label class="form-check-label " for="memberCheckAll">全選</label>
                            </div>
                            <div class="btn-group" role="group">
                              <input name="member" type="checkbox" class="btn-check" id="viewmember" autocomplete="off" onclick="allCheck('memberCheckAll','member')" checked="true">
                              <label class="btn btn-outline-info" for="viewmember">檢視</label>
                        
                              <input name="member" type="checkbox" class="btn-check" id="editmember" autocomplete="off" onclick="allCheck('memberCheckAll','member')">
                              <label class="btn btn-outline-info" for="editmember">編輯</label>
                        
                            </div>
                          </div>
                        </div>
                        <div class="permissionItem m-3 ">
                          <h6>積分管理</h6>
                          <div class="bg-secondary rounded h-100 p-1 d-flex">
                            <div class="form-check form-switch me-4 d-flex align-items-center"> 
                              <input class="form-check-input me-2" name="isAuthorized[]"  value=1 type="checkbox" role="switch" id="pointCheckAll" onclick="checkAll(this,'point')">
                              <label class="form-check-label " for="pointCheckAll">全選</label>
                            </div>
                            <div class="btn-group" role="group">
                              <input name="point" type="checkbox" class="btn-check" id="viewpoint" autocomplete="off" onclick="allCheck('pointCheckAll','point')" checked="true">
                              <label class="btn btn-outline-info" for="viewpoint">檢視</label>
                        
                              <input name="point" type="checkbox" class="btn-check" id="editpoint" autocomplete="off" onclick="allCheck('pointCheckAll','point')">
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
                              <input class="form-check-input me-2" name="isAuthorized[]" value=1  type="checkbox" role="switch" id="itineraryCheckAll" onclick="checkAll(this,'itinerary')">
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
                              <input class="form-check-input me-2" name="isAuthorized[]" value=1  type="checkbox" role="switch" id="orderCheckAll" onclick="checkAll(this,'order')">
                              <label class="form-check-label " for="orderCheckAll">全選</label>
                            </div>
                            <div class="btn-group" role="group">
                              <input name="order" type="checkbox" class="btn-check" id="vieworder" autocomplete="off" onclick="allCheck('orderCheckAll','order')" checked="true">
                              <label class="btn btn-outline-info" for="vieworder">檢視</label>
                        
                              <input name="order" type="checkbox" class="btn-check" id="editorder" autocomplete="off" onclick="allCheck('orderCheckAll','order')">
                              <label class="btn btn-outline-info" for="editorder">編輯</label>
                            </div>
                          </div>
                        </div>
                        <div class="permissionItem m-3">
                          <h6>商品上架管理</h6>
                          <div class="bg-secondary rounded h-100 p-1 d-flex">
                            <div class="form-check form-switch me-4 d-flex align-items-center">
                              <input class="form-check-input me-2" name="isAuthorized[]" value=1 type="checkbox" role="switch" id="productCheckAll" onclick="checkAll(this,'product')">
                              <label class="form-check-label " for="productCheckAll">全選</label>
                            </div>
                            <div class="btn-group" role="group">
                              <input name="product" type="checkbox" class="btn-check" id="viewproduct" autocomplete="off"  checked="true" onclick="allCheck('productCheckAll','product')">
                              <label class="btn btn-outline-info" for="viewproduct" >檢視</label>
                        
                              <input name="product" type="checkbox" class="btn-check" id="editproduct" autocomplete="off" onclick="allCheck('productCheckAll','product')">
                              <label class="btn btn-outline-info" for="editproduct" >編輯</label>
                            </div>
                          </div>
                        </div>
                        <div class="permissionItem m-3">
                          <h6>表單管理</h6>
                          <div class="bg-secondary rounded h-100 p-1 d-flex">
                            <div class="form-check form-switch me-4 d-flex align-items-center">
                              <input class="form-check-input me-2" name="isAuthorized[]" value=1 type="checkbox" role="switch" id="formCheckAll" onclick="checkAll(this,'form')">
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
                if(!empty($_POST)){
                  $the_employee = $_SESSION['admin'] ['employee_id'];
                  $new_role_sql = 
                    "INSERT INTO `role_set`(`role_name`, `description`, `created_at`, `employee_id`) VALUES ('".$_POST['new_role_name']."',".$_POST['new_role_desc'].",NOW(),'$the_employee')";
                  $conn->query($new_role_sql);

                  $new_role_result = $conn->query("SELECT role_id FROM role_set order by created_at desc limit 1")->fetch_assoc();
                  $new_role_id = $new_role_result['$role_id'];
                  


                     //執行語法，透過 PDO 物件導向到 query
                  header("location:roleList.php"); //最後我們轉回去一個適合的網頁位置
                }




                  //新增逻辑
                  

                ?>
              </div>
            </div>
          </div>
          <!-- add form end -->          
        </div>

        <div class="descript">
            <p>說明：<i class="fa-solid fa-pen-to-square me-1"></i>可供編輯、<i class="fa-solid fa-eye me-1"></i>僅供檢視</p>
        </div>

        <table class="table table-bordered">
          <thead>
            <tr>
              <th  scope="col" class="text-center">角色名稱</th>
              <th  scope="col" class="text-center">角色權限管理</th>
              <th  scope="col" class="text-center">員工管理</th>
              <th  scope="col" class="text-center">會員管理</th>
              <th  scope="col" class="text-center">積分管理</th>
              <th  scope="col" class="text-center">套裝行程管理</th>
              <th  scope="col" class="text-center">訂單管理</th>
              <th  scope="col" class="text-center">商品上架管理</th>
              <th  scope="col" class="text-center">表單管理</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($permission_result as $r): ?>
            <tr>
            <td class="text-center"><?= $r['role_name']?></td>
              <td class="text-center">
                <?php
                  if ($r['role_set']) {
                    echo '<i class="fa-solid fa-pen-to-square"></i>';
                  }else {
                    echo '<i class="fa-solid fa-eye"></i>';
                  }
                ?>
              </td>
              <td class="text-center">
                <?php
                  if ($r['employees']) {
                    echo '<i class="fa-solid fa-pen-to-square"></i>';
                  }else {
                    echo '<i class="fa-solid fa-eye"></i>';
                  }
                ?>
              </td>
              <td class="text-center">
                <?php
                  if ($r['members']) {
                    echo '<i class="fa-solid fa-pen-to-square"></i>';
                  }else {
                    echo '<i class="fa-solid fa-eye"></i>';
                  }
                ?>
              </td>
              <td class="text-center">
                <?php
                  if ($r['points']) {
                    echo '<i class="fa-solid fa-pen-to-square"></i>';
                  }else {
                    echo '<i class="fa-solid fa-eye"></i>';
                  }
                ?>
              </td>
              <td class="text-center">
                <?php
                  if ($r['itinerary']) {
                    echo '<i class="fa-solid fa-pen-to-square"></i>';
                  }else {
                    echo '<i class="fa-solid fa-eye"></i>';
                  }
                ?>
              </td>
              <td class="text-center">
                <?php
                  if ($r['orders']) {
                    echo '<i class="fa-solid fa-pen-to-square"></i>';
                  }else {
                    echo '<i class="fa-solid fa-eye"></i>';
                  }
                ?>
              </td>
              <td class="text-center">
                <?php
                  if ($r['products']) {
                    echo '<i class="fa-solid fa-pen-to-square"></i>';
                  }else {
                    echo '<i class="fa-solid fa-eye"></i>';
                  }
                ?>
              </td>
              <td class="text-center">
                <?php
                  if ($r['form']) {
                    echo '<i class="fa-solid fa-pen-to-square"></i>';
                  }else {
                    echo '<i class="fa-solid fa-eye"></i>';
                  }
                ?>
              </td>

            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
        
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
    if (checkboxs[0].checked&&checkboxs[1].checked) {
      return checkswitch.checked = true;
    }else{
      return checkswitch.checked = false;
    }


  }

<?php include __DIR__ . '/parts/html-foot.php' ?>