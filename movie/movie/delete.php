<?php
// 連接到資料庫
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "電影訂票系統";
$conn = new mysqli('localhost', 'username', 'password', 'database');

// 檢查連接是否成功
if ($conn->connect_error) {
    die("連接失敗: " . $conn->connect_error);
}

// 獲取 URL 中的 ID
$id = $_GET['id'];

// 從資料庫中刪除相應的資料
$sql = "DELETE FROM movie WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    echo "資料已成功刪除";
} else {
    echo "刪除資料時出錯: " . $conn->error;
}

$conn->close();
?>