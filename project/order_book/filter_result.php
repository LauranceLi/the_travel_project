<?php
require __DIR__ . '/parts/pdo-connect.php';
$orderStatus = isset($_POST['order_status']) ? $_POST['order_status'] : '';
$paymentStatus = isset($_POST['payment_status']) ? $_POST['payment_status'] : '';
$shippingStatus = isset($_POST['shipping_status']) ? $_POST['shipping_status'] : '';

$sql_select = "SELECT * FROM `order` WHERE 1=1"; // 1=1 是為了方便後續的 SQL 條件拼接

if (!empty($orderStatus)) {
    $sql_select .= " AND `order_status` = :order_status";
}
if (!empty($paymentStatus)) {
    $sql_select .= " AND `payment_status` = :payment_status";
}
if (!empty($shippingStatus)) {
    $sql_select .= " AND `shipping_status` = :shipping_status";
}
$stmt_select = $pdo->prepare($sql_select);
if (!empty($orderStatus)) {
    $stmt_select->bindParam(':order_status', $orderStatus, PDO::PARAM_STR);
}
if (!empty($paymentStatus)) {
    $stmt_select->bindParam(':payment_status', $paymentStatus, PDO::PARAM_STR);
}
if (!empty($shippingStatus)) {
    $stmt_select->bindParam(':shipping_status', $shippingStatus, PDO::PARAM_STR);
}
$stmt_select->execute();
$searchResults = $stmt_select->fetchAll();
?>
<?php include __DIR__ . '/parts/html-head.php' ?>
<?php include __DIR__ . '/parts/navbar.php' ?>
<div class="container">
    <div class="row">
        <div class="col mt-3">
            <?php include __DIR__ . '/filter.php'; ?>
            <?php include __DIR__ . '/search_input.php'; ?>
            <div class="mt-3">
                <a class="btn btn-primary" href="./list-admin.php">返回列表</a>
            </div>
            <?php if (empty($searchResults)) : ?>
                <table class="table table-bordered table-striped mt-3">
                    <tr>
                        <th>訂單狀態</th>
                        <th>交易編號</th>
                        <th>訂購人姓名</th>
                        <th>總金額</th>
                        <th>付費方式</th>
                        <th>付費狀態</th>
                        <th>送貨方式</th>
                        <th>送貨狀態</th>
                        <th>送貨地址</th>
                        <th>送貨日期</th>
                        <th>下單日期</th>
                        <th><i class="fa-solid fa-file-pen"></i></th>
                        <th><i class="fa-solid fa-trash"></i></th>
                    </tr>
                    <?php foreach ($searchResults as $result) {
                        echo '<tr>';
                        echo '<td>', $result['order_status'], '</td>';
                        echo '<td><a href="order_detail.php?transaction_id=' . htmlentities($result['transaction_id']) . '">', $result['transaction_id'], '</a></td>';
                        echo '<td>', $result['purchaser_name'], '</td>';
                        echo '<td>', $result['total_amount'], '</td>';
                        echo '<td>', $result['payment_method'], '</td>';
                        echo '<td>', $result['payment_status'], '</td>';
                        echo '<td>', $result['shipping_method'], '</td>';
                        echo '<td>', $result['shipping_status'], '</td>';
                        echo '<td>', $result['shipping_address'], '</td>';
                        echo '<td>', $result['shipping_date'], '</td>';
                        echo '<td>', $result['order_date'], '</td>';
                        echo '<td><a href="edit.php?order_id=', $result['order_id'], '"><i class="fa-solid fa-file-pen"></i></a></td>';
                        echo '<td><a href="javascript:deleteOne(', $result['order_id'], ')"><i class="fa-solid fa-trash"></i></a></td>';
                        echo '</tr>';
                        echo "\n";
                    }
                    ?>
                </table>
            <?php else : ?>
                <table class="table table-bordered table-striped  mt-3">
                    <tr>
                        <th>訂單狀態</th>
                        <th>交易編號</th>
                        <th>訂購人姓名</th>
                        <th>總金額</th>
                        <th>付費方式</th>
                        <th>付費狀態</th>
                        <th>送貨方式</th>
                        <th>送貨狀態</th>
                        <th>送貨地址</th>
                        <th>送貨日期</th>
                        <th>下單日期</th>
                        <th><i class="fa-solid fa-file-pen"></i></th>
                        <th><i class="fa-solid fa-trash"></i></th>
                    </tr>
                    <?php foreach ($searchResults as $result) {
                        echo '<tr>';
                        echo '<td>', $result['order_status'], '</td>';
                        echo '<td><a href="order_detail.php?transaction_id=' . htmlentities($result['transaction_id']) . '">', $result['transaction_id'], '</a></td>';
                        echo '<td>', $result['purchaser_name'], '</td>';
                        echo '<td>', $result['total_amount'], '</td>';
                        echo '<td>', $result['payment_method'], '</td>';
                        echo '<td>', $result['payment_status'], '</td>';
                        echo '<td>', $result['shipping_method'], '</td>';
                        echo '<td>', $result['shipping_status'], '</td>';
                        echo '<td>', $result['shipping_address'], '</td>';
                        echo '<td>', $result['shipping_date'], '</td>';
                        echo '<td>', $result['order_date'], '</td>';
                        echo '<td><a href="edit.php?order_id=', $result['order_id'], '"><i class="fa-solid fa-file-pen"></i></a></td>';
                        echo '<td><a href="javascript:deleteOne(', $result['order_id'], ')"><i class="fa-solid fa-trash"></i></a></td>';
                        echo '</tr>';
                        echo "\n";
                    }
                    ?>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/parts/html-foot.php' ?>