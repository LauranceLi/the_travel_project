<?php
if(isset($_POST['sign_up'])) {
    $selected_sign_up = $_POST['sign_up'];
    echo "你選擇了出團狀態：$selected_sign_up";
} else {
    echo "請選擇一個出團狀態";
}
?>