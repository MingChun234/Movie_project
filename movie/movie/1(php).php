<?php
session_start();

$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "電影訂票系統";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$date = $_POST['date'];
$time = $_POST['time'];
$quantity = $_POST['number'];
$name='青春豬頭少年不會夢到紅書包女孩';


if ($_POST['number'] == 0) {
    $_SESSION['message'] = "購買數量不能為 0";
    header("Location: 1.php"); 
    exit;
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

$sql = "INSERT INTO $table_name (name,date, time, number) VALUES ('$name','$date', '$time', '$quantity')";


if ($conn->query($sql) === TRUE) {
    echo "訂票成功";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>


<form action="all-2.php" method="post">
    <input type="submit" value="繼續購買">
</form>