<?php
require __DIR__ . '/parts/pdo_connect.php';
session_start();
$title = "Role List";
$pageName = 'roleList';
?>

<?php include __DIR__ . '/parts/html-head.php' ?>


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

          <!-- Modal -->
          <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content bg-secondary border-0">
                <form action="" method="post">
                  <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">新增角色</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <div class="modal-body ">
                    <h6>角色名稱</h6>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" placeholder="新建名稱" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="permissionItem m-4 ">
                      <h6>角色設置</h6>
                      <div class="bg-secondary rounded h-100 p-1 d-flex">
                        <div class="form-check form-switch me-4 d-flex align-items-center">
                          <input class="form-check-input me-2" name="roleSetCheckAll" type="checkbox" role="switch" id="roleSetCheckAll" onclick="checkAll(this,'roleSet')">
                          <label class="form-check-label " for="roleSetCheckAll">全選</label>
                        </div>
                        <div class="btn-group" role="group">
                          <input name="roleSet" type="checkbox" class="btn-check" id="viewroleSet" autocomplete="off" onclick="allCheck('roleSetCheckAll','roleSet') " checked="true">
                          <label class="btn btn-outline-info" for="viewroleSet">檢視</label>

                          <input name="roleSet" type="checkbox" class="btn-check" id="addroleSet" autocomplete="off" onclick="allCheck('roleSetCheckAll','roleSet')">
                          <label class="btn btn-outline-info" for="addroleSet">新增</label>

                          <input name="roleSet" type="checkbox" class="btn-check" id="editroleSet" autocomplete="off" onclick="allCheck('roleSetCheckAll','roleSet')">
                          <label class="btn btn-outline-info" for="editroleSet">編輯</label>

                          <input name="roleSet" type="checkbox" class="btn-check" id="deleteroleSet" autocomplete="off" onclick="allCheck('roleSetCheckAll','roleSet')">
                          <label class="btn btn-outline-info" for="deleteroleSet">刪除</label>
                        </div>
                      </div>
                    </div>
                    <div class="permissionItem m-4 ">
                      <h6>員工管理</h6>
                      <div class="bg-secondary rounded h-100 p-1 d-flex">
                        <div class="form-check form-switch me-4 d-flex align-items-center">
                          <input class="form-check-input me-2" name="employeeCheckAll" type="checkbox" role="switch" id="employeeCheckAll" onclick="checkAll(this,'employee')">
                          <label class="form-check-label " for="employeeCheckAll">全選</label>
                        </div>
                        <div class="btn-group" role="group">
                          <input name="employee" type="checkbox" class="btn-check" id="viewemployee" autocomplete="off" onclick="allCheck('employeeCheckAll','employee')" checked="true">
                          <label class="btn btn-outline-info" for="viewemployee">檢視</label>

                          <input name="employee" type="checkbox" class="btn-check" id="addemployee" autocomplete="off" onclick="allCheck('employeeCheckAll','employee')">
                          <label class="btn btn-outline-info" for="addemployee">新增</label>

                          <input name="employee" type="checkbox" class="btn-check" id="editemployee" autocomplete="off" onclick="allCheck('employeeCheckAll','employee')">
                          <label class="btn btn-outline-info" for="editemployee">編輯</label>

                          <input name="employee" type="checkbox" class="btn-check" id="deleteemployee" autocomplete="off" onclick="allCheck('employeeCheckAll','employee')">
                          <label class="btn btn-outline-info" for="deleteemployee">刪除</label>
                        </div>
                      </div>
                    </div>
                    <div class="permissionItem m-4 ">
                      <h6>會員管理</h6>
                      <div class="bg-secondary rounded h-100 p-1 d-flex">
                        <div class="form-check form-switch me-4 d-flex align-items-center">
                          <input class="form-check-input me-2" name="memberCheckAll" type="checkbox" role="switch" id="memberCheckAll" onclick="checkAll(this,'member')">
                          <label class="form-check-label " for="memberCheckAll">全選</label>
                        </div>
                        <div class="btn-group" role="group">
                          <input name="member" type="checkbox" class="btn-check" id="viewmember" autocomplete="off" onclick="allCheck('memberCheckAll','member')" checked="true">
                          <label class="btn btn-outline-info" for="viewmember">檢視</label>

                          <input name="member" type="checkbox" class="btn-check" id="addmember" autocomplete="off" onclick="allCheck('memberCheckAll','member')">
                          <label class="btn btn-outline-info" for="addmember">新增</label>

                          <input name="member" type="checkbox" class="btn-check" id="editmember" autocomplete="off" onclick="allCheck('memberCheckAll','member')">
                          <label class="btn btn-outline-info" for="editmember">編輯</label>

                          <input name="member" type="checkbox" class="btn-check" id="deletemember" autocomplete="off" onclick="allCheck('memberCheckAll','member')">
                          <label class="btn btn-outline-info" for="deletemember">刪除</label>
                        </div>
                      </div>
                    </div>
                    <div class="permissionItem m-4 ">
                      <h6>積分管理</h6>
                      <div class="bg-secondary rounded h-100 p-1 d-flex">
                        <div class="form-check form-switch me-4 d-flex align-items-center">
                          <input class="form-check-input me-2" name="pointCheckAll" type="checkbox" role="switch" id="pointCheckAll" onclick="checkAll(this,'point')">
                          <label class="form-check-label " for="pointCheckAll">全選</label>
                        </div>
                        <div class="btn-group" role="group">
                          <input name="point" type="checkbox" class="btn-check" id="viewpoint" autocomplete="off" onclick="allCheck('pointCheckAll','point')" checked="true">
                          <label class="btn btn-outline-info" for="viewpoint">檢視</label>

                          <input name="point" type="checkbox" class="btn-check" id="addpoint" autocomplete="off" onclick="allCheck('pointCheckAll','point')">
                          <label class="btn btn-outline-info" for="addpoint">新增</label>

                          <input name="point" type="checkbox" class="btn-check" id="editpoint" autocomplete="off" onclick="allCheck('pointCheckAll','point')">
                          <label class="btn btn-outline-info" for="editpoint">編輯</label>

                          <input name="point" type="checkbox" class="btn-check" id="deletepoint" autocomplete="off" onclick="allCheck('pointCheckAll','point')">
                          <label class="btn btn-outline-info" for="deletepoint">刪除</label>
                        </div>
                      </div>
                    </div>
                    <div class="permissionItem m-4 ">

                      <h6>套裝行程管理</h6>
                      <div class="bg-secondary rounded h-100 p-1 d-flex">
                        <div class="form-check form-switch me-4 d-flex align-items-center">
                          <input class="form-check-input me-2" name="itineraryCheckAll" type="checkbox" role="switch" id="itineraryCheckAll" onclick="checkAll(this,'itinerary')">
                          <label class="form-check-label " for="itineraryCheckAll">全選</label>
                        </div>
                        <div class="btn-group" role="group">
                          <input name="itinerary" type="checkbox" class="btn-check" id="viewitinerary" autocomplete="off" onclick="allCheck('itineraryCheckAll','itinerary')" checked="true">
                          <label class="btn btn-outline-info" for="viewitinerary">檢視</label>

                          <input name="itinerary" type="checkbox" class="btn-check" id="additinerary" autocomplete="off" onclick="allCheck('itineraryCheckAll','itinerary')">
                          <label class="btn btn-outline-info" for="additinerary">新增</label>

                          <input name="itinerary" type="checkbox" class="btn-check" id="edititinerary" autocomplete="off" onclick="allCheck('itineraryCheckAll','itinerary')">
                          <label class="btn btn-outline-info" for="edititinerary">編輯</label>

                          <input name="itinerary" type="checkbox" class="btn-check" id="deleteitinerary" autocomplete="off" onclick="allCheck('itineraryCheckAll','itinerary')">
                          <label class="btn btn-outline-info" for="deleteitinerary">刪除</label>
                        </div>
                      </div>
                    </div>
                    <div class="permissionItem m-4">

                      <h6>訂單管理</h6>
                      <div class="bg-secondary rounded h-100 p-1 d-flex">
                        <div class="form-check form-switch me-4 d-flex align-items-center">
                          <input class="form-check-input me-2" name="orderCheckAll" type="checkbox" role="switch" id="orderCheckAll" onclick="checkAll(this,'order')">
                          <label class="form-check-label " for="orderCheckAll">全選</label>
                        </div>
                        <div class="btn-group" role="group">
                          <input name="order" type="checkbox" class="btn-check" id="vieworder" autocomplete="off" onclick="allCheck('orderCheckAll','order')" checked="true">
                          <label class="btn btn-outline-info" for="vieworder">檢視</label>

                          <input name="order" type="checkbox" class="btn-check" id="addorder" autocomplete="off" onclick="allCheck('orderCheckAll','order')">
                          <label class="btn btn-outline-info" for="addorder">新增</label>

                          <input name="order" type="checkbox" class="btn-check" id="editorder" autocomplete="off" onclick="allCheck('orderCheckAll','order')">
                          <label class="btn btn-outline-info" for="editorder">編輯</label>

                          <input name="order" type="checkbox" class="btn-check" id="deleteorder" autocomplete="off" onclick="allCheck('orderCheckAll','order')">
                          <label class="btn btn-outline-info" for="deleteorder">刪除</label>
                        </div>
                      </div>
                    </div>
                    <div class="permissionItem m-4">

                      <h6>商品上架管理</h6>
                      <div class="bg-secondary rounded h-100 p-1 d-flex">
                        <div class="form-check form-switch me-4 d-flex align-items-center">
                          <input class="form-check-input me-2" name="productCheckAll" type="checkbox" role="switch" id="productCheckAll" onclick="checkAll(this,'product')">
                          <label class="form-check-label " for="productCheckAll">全選</label>
                        </div>
                        <div class="btn-group" role="group">
                          <input name="product" type="checkbox" class="btn-check" id="viewproduct" autocomplete="off" onclick="allCheck('productCheckAll','product')" checked="true">
                          <label class="btn btn-outline-info" for="viewproduct">檢視</label>

                          <input name="product" type="checkbox" class="btn-check" id="addproduct" autocomplete="off" onclick="allCheck('productCheckAll','product')">
                          <label class="btn btn-outline-info" for="addproduct">新增</label>

                          <input name="product" type="checkbox" class="btn-check" id="editproduct" autocomplete="off" onclick="allCheck('productCheckAll','product')">
                          <label class="btn btn-outline-info" for="editproduct">編輯</label>

                          <input name="product" type="checkbox" class="btn-check" id="deleteproduct" autocomplete="off" onclick="allCheck('productCheckAll','product')">
                          <label class="btn btn-outline-info" for="deleteproduct">刪除</label>
                        </div>
                      </div>
                    </div>
                    <div class="permissionItem m-4">
                      <h6>表單管理</h6>
                      <div class="bg-secondary rounded h-100 p-1 d-flex">
                        <div class="form-check form-switch me-4 d-flex align-items-center">
                          <input class="form-check-input me-2" name="formCheckAll" type="checkbox" role="switch" id="formCheckAll" onclick="checkAll(this,'form')">
                          <label class="form-check-label " for="formCheckAll">全選</label>
                        </div>
                        <div class="btn-group" role="group">
                          <input name="form" type="checkbox" class="btn-check" id="viewform" autocomplete="off" onclick="allCheck('formCheckAll','form')" checked="true">
                          <label class="btn btn-outline-info" for="viewform">檢視</label>

                          <input name="form" type="checkbox" class="btn-check" id="addform" autocomplete="off" onclick="allCheck('formCheckAll','form')">
                          <label class="btn btn-outline-info" for="addform">新增</label>

                          <input name="form" type="checkbox" class="btn-check" id="editform" autocomplete="off" onclick="allCheck('formCheckAll','form')">
                          <label class="btn btn-outline-info" for="editform">編輯</label>

                          <input name="form" type="checkbox" class="btn-check" id="deleteform" autocomplete="off" onclick="allCheck('formCheckAll','form')">
                          <label class="btn btn-outline-info" for="deleteform">刪除</label>
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-outline-info">新增</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">角色類別</th>
              <th scope="col">角色設置</th>
              <th scope="col">會員管理</th>
              <th scope="col">積分管理</th>
              <th scope="col">套裝行程管理</th>
              <th scope="col">訂單管理</th>
              <th scope="col">商品上架管理</th>
              <th scope="col">表單管理</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td>John</td>
              <td><i class="fa-solid fa-eye"></i></td>
              <td><i class="fa-solid fa-eye"></i></td>
              <td><i class="fa-solid fa-pen-to-square"></i></td>
              <td><i class="fa-solid fa-pen-to-square"></i></td>
              <td><i class="fa-solid fa-pen-to-square"></i></td>
              <td><i class="fa-solid fa-pen-to-square"></i></td>
            </tr>

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
    let count = 0;

    for (let i = 0; i < checkboxs.length; i++) {
      if (checkboxs[i].checked) {
        count++;
      }
    }
    if (count == checkboxs.length) {
      return checkswitch.checked = true;
    }
  }
</script>
<?php include __DIR__ . '/parts/html-foot.php' ?>