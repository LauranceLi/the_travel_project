<?php
require __DIR__ . '/parts/pdo_connect.php';
session_start();
// print_r($_POST);

if (!empty($_POST)) {
  $the_employee = $_SESSION['admin']['employee_id'];
  $new_role_sql = "INSERT INTO `role_set`(`role_name`, `description`, `created_at`, `employee_id`) VALUES ('" . $_POST['new_role_name'] . "','" . $_POST['new_role_desc'] . "',NOW(),'$the_employee')";
  $new_role_result = $conn->query($new_role_sql);

  $new_role_row = $conn->query("SELECT role_id FROM role_set order by created_at desc limit 1")->fetch_assoc();

  $new_role_id = $new_role_row['role_id'];
  //新增逻辑

  $isAuthorized = isset($_POST['isAuthorized']) ? $_POST['isAuthorized'] : [];
  // $roleSetAuthorized = in_array(1, $isAuthorized) ? 1 : 0;
  // $employeesAuthorized = in_array(2, $isAuthorized) ? 1 : 0;
  // $membersAuthorized = in_array(3, $isAuthorized) ? 1 : 0;
  // $pointsAuthorized = in_array(4, $isAuthorized) ? 1 : 0;
  // $itineraryAuthorized = in_array(5, $isAuthorized) ? 1 : 0;
  // $ordersAuthorized = in_array(6, $isAuthorized) ? 1 : 0;
  // $productsAuthorized = in_array(7, $isAuthorized) ? 1 : 0;
  // $formAuthorized = in_array(8, $isAuthorized) ? 1 : 0;

  $roleSet = isset($_POST['roleSet']);# ? $_POST['roleSet'] : 'noAuthority';
  $employee = isset($_POST['employee']);# ? $_POST['employee'] : 'noAuthority';
  $member = isset($_POST['member']);# ? $_POST['member'] : 'noAuthority';
  $point = isset($_POST['point']);# ? $_POST['point'] : 'noAuthority';
  $itinerary = isset($_POST['itinerary']);# ? $_POST['itinerary'] : 'noAuthority';
  $order = isset($_POST['order']);# ? $_POST['order'] : 'noAuthority';
  $product = isset($_POST['product']);# ? $_POST['product'] : 'noAuthority';
  $form = isset($_POST['form']);# ? $_POST['form'] : 'noAuthority';

  
  function authorized($sql) {
    if (empty($sql)){
      return 'noAuthority';
    } else if (in_array('edit', $sql)) {
      return 'edit';
    } else {
      return 'view';
    }
    }
  
    $roleSetAuthorized = authorized($_POST['roleSet']);
    $employeesAuthorized = authorized($_POST['employee']);
    $membersAuthorized = authorized($_POST['member']);
    $pointsAuthorized = authorized($_POST['point']);
    $itineraryAuthorized = authorized($_POST['itinerary']);
    $ordersAuthorized = authorized($_POST['order']);
    $productsAuthorized = authorized($_POST['product']);
    $formAuthorized = authorized($_POST['form']);



  $isAuthorized_sql =
    "INSERT INTO `permission`(`permission_role_id`, `role_set`, `employees`, `members`, `points`, `itinerary`, `orders`, `products`, `form`)VALUES ($new_role_id,'$roleSetAuthorized','$employeesAuthorized','$membersAuthorized','$pointsAuthorized','$itineraryAuthorized','$ordersAuthorized','$productsAuthorized','$formAuthorized')";

  $isAuthorized_sql_result = $conn->query($isAuthorized_sql);
  header("Location: roleList-success.php");
  exit; 
}
