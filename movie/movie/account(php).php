<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
   
    $account_name = $_POST["account_name"];
    $password = $_POST["password"];

    $servername = "localhost";
    $username = "root";
    $dbpassword = "";
    $dbname = "電影訂票系統";

    $conn = new mysqli($servername, $username, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $account_name = $conn->real_escape_string($account_name);

    if (preg_match("/^[A-Za-z0-9]*$/", $account_name) && preg_match("/^[A-Za-z0-9]*$/", $password)) {
    
    $ap_Check = "SELECT * FROM account WHERE account_name = '$account_name'";
    $resultCheck = $conn->query($ap_Check);
    
    if ($conn->error) {
        echo "查詢失敗： " . $conn->error;
        exit;
    }
    
    if ($resultCheck && $resultCheck->num_rows > 0) {
        echo "帳號已存在";
        echo '<form action="account.php" method="post"><input type="submit" value="返回登入"></form>';
        exit;
    }
    
    $sql = "INSERT INTO account (account_name, password) VALUES ('$account_name', '$password')";
    
    if ($conn->query($sql) === TRUE) {
        echo "註冊成功";
    } else {
        echo "錯誤: " . $conn->error;
    }
}
}
?>

<form action="in.php" method="post">
        <input type="submit" value="返回登入">
    </form>