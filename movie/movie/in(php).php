<?php

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
  $ap_check = "SELECT * FROM account WHERE account_name	 = '$account_name'";
  $resultCheck = $conn->query($ap_check);
  

  if ($conn->error) {
    echo "查詢失敗： " . $conn->error;
    exit;
}

  $storedPassword = null; 
  
  if ($resultCheck->num_rows > 0) {
    $row = $resultCheck->fetch_assoc();
    if (!empty($row)) {
      $storedPassword = $row["password"];
    }
  }

    if ($password === $storedPassword) {
      
      session_start();
      $_SESSION['logged_in'] = true;
      $_SESSION['account_name'] = $account_name;
      
      header("Location: all-2.php");
      
      $account_name = $conn->real_escape_string($account_name);
      $table_name = $account_name . "_cart";
  
      $check_table = "SHOW TABLES LIKE '$table_name'";
      $result = $conn->query($check_table);
      $message = "";
  
      if($result->num_rows == 0) {
      $sql = "CREATE TABLE `$table_name` (
          `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
          `name` text NOT NULL,
          `date` date NOT NULL,
          `time` char(20) NOT NULL,
          `number` int(11) NOT NULL,
          `price` int(11) NOT NULL DEFAULT 250
      )";
  
      if ($conn->query($sql) === TRUE) {
          $message = "資料表創建成功";
      } else {
          $message = "創建資料表時出錯: " . $conn->error;
      }
    }
    exit();

    } else {
      // 檢查資料庫中是否存在該帳號
      $account_name = $conn->real_escape_string($account_name);
      $sql = "SELECT * FROM account WHERE account_name = '$account_name'";
      $result = $conn->query($sql);
  
      if ($result->num_rows > 0) {
          echo "密碼錯誤";
          echo '<form action="in.php" method="post">';
          echo '<input type="submit" value="重新輸入">';
          echo '</form>';
      } else {
          echo "用戶不存在";
          echo '<form action="account.php" method="post">';
          echo '<input type="submit" value="前往註冊">';
          echo '</form>';
      }
  }

  $conn->close();
}
?>
