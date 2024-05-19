<html>
    <head>
        <meta charset="UTF-8">
        <title>刪除帳號</title>
    </head>
    <body>
        
    
<?php
    session_start(); // 啟動 session
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "電影訂票系統";

    // 建立連線
    $conn = new mysqli($servername, $username, $password, $dbname);

    // 檢查連線
    if ($conn->connect_error) {
        die("連線失敗: " . $conn->connect_error);
    }

    if (isset($_SESSION['account_name'])) {
        $account_name = $_SESSION['account_name'];

        // 刪除 account 資料表中的帳號
        $sql = "DELETE FROM `account` WHERE account_name = '$account_name'";
        $sql2 = "DELETE FROM '$account_name'";
        if ($conn->query($sql) === TRUE || $conn->query($sql2) === TRUE) {
            echo "帳號 $account_name 已經被刪除\n";
        } else {
            echo "刪除帳號 $account_name 時發生錯誤: " . $conn->error . "\n";
        }

        // 刪除對應的 account_cart 資料表
        $account_name = $conn->real_escape_string($account_name);
        $table_name = $account_name . "_cart";
        echo $table_name;
        $delete_table = "DROP TABLE IF EXISTS `$table_name`";
        if ($conn->query($delete_table) === TRUE) {
        echo "資料表 $table_name 已經被刪除\n";
            } else {
        echo "刪除資料表 $table_name 時發生錯誤: " . $conn->error . "\n";
        }
        } else {
        echo "account_name 未設定";
        }

        $conn->close();
?>

    </body>
</html>