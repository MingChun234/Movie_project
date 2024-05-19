<?php
session_start();

$servername = "localhost";
$username = "root";
$dbpassword = "";
$dbname = "電影訂票系統";

$conn = new mysqli($servername, $username, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['account_name'])) {
    $account_name = $_SESSION['account_name'];
} else {
    // 處理帳號名稱不存在的情況
    echo "您尚未登入";
    exit;
}

$account_name = $conn->real_escape_string($account_name);
$table_name = $account_name . "_cart";

// 先檢查購物車是否有資料
$check_table = "SHOW TABLES LIKE '$table_name'";
$result = $conn->query($check_table);

if ($result->num_rows > 0) {
    // 如果購物車有資料，則清空購物車並顯示訊息
    $sql = "DELETE FROM $table_name";
    $sql2 = "TRUNCATE TABLE your_table_name";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "購物車已清空";
    } else {
        $_SESSION['message'] = "清空購物車時發生異常: " . $conn->error;
    }
}
// 清空購物車後執行的程式碼
    $sql2 = "TRUNCATE TABLE $table_name";  
    if ($conn->query($sql2) === TRUE) {
    // SQL 語句執行成功
    } else {
    // SQL 語句執行失敗
        echo "錯誤: " . $sql2 . "<br>" . $conn->error;
}
$conn->close();

header("Location: all-2.php"); // 將使用者重新導向到 all-2.php
?>

