<?php
session_start();

    $servername = "localhost";
    $username = "root";
    $password = ""; 
    $dbname = "電影訂票系統";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("連接失敗: " . $conn->connect_error);
    }

$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']);

$images = ['多拉a夢.gif', '多拉美.gif']; 
$randomImage = $images[rand(0, count($images) - 1)];
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: 	#BBFFFF;
            margin: 0;
            padding: 20px;
        }
        
        .circle {
            width: 35px;
            height: 35px;
            border-radius: 50%; 
            position: fixed;
            top: 10px;
            right: 10px;
            border: 2px solid #fff;
            background-image: url('<?php echo $randomImage; ?>');
            background-size: cover; 
            background-position: center; 
        }

        .circle:hover {
            cursor: pointer;
            transform: scale(1.1);
        }

        .account-info {
            position: fixed;
            top: 17px;
            right: 70px; 
            font-size: 16px; 
            color: #000; 
            font-weight: bold;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }        
        .box {
            padding: 20px;
            border: 1px solid black;
            text-align: center;
            background-color: #BE77FF;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php
        $account_name = $_SESSION['account_name']; 
        $account_name = $conn->real_escape_string($account_name); // 避免 SQL Injection
    ?>
    <div class="circle"></div>
    <div class="account-info">歡迎，帳號<?php echo $account_name; ?></div>
    <div class="container">
        <div class="box">
        <h2>購買紀錄</h2>
        <table border="1">
                <tr>
                    <th>電影名稱</th>
                    <th>日期</th>
                    <th>場次時間</th>
                    <th>購買數量</th>
                    <th>票價</th>
                    <th>總金額</th>
                    <th></th>
                </tr>
<?php

if (isset($_SESSION['account_name'])) {
     $account_name  =  $_SESSION['account_name'];
} else {
    // 處理帳號名稱不存在的情況
    echo "您尚未登入";
    exit;
}

$account_name = $conn->real_escape_string($account_name);
$table_name = $account_name . "_cart";

$check_table = "SHOW TABLES LIKE '$table_name'";
$result = $conn->query($check_table);

$sql = "SELECT * FROM `$table_name` WHERE number >= 1";

$result = $conn->query($sql);

if ($result === FALSE) {
    die("Error: " . $conn->error);
}

// 處理結果集
while ($row = $result->fetch_assoc()) {
    $total = $row['number'] * $row['price'];
    
    echo '<tr>';
    echo '<td>' . $row['name'] . '</td>';
    echo '<td>' . $row['date'] . '</td>';
    echo '<td>' . $row['time'] . '</td>';  
    echo '<td>' . $row['number'] . '</td>';
    echo '<td>' . $row['price'] . '</td>';
    echo '<td>' . $total . '</td>';
    echo '<td><a href="edit.php?id=' . $row['id'] . '">編輯</a> | <a href="delete.php?id=' . $row['id'] . '">刪除</a></td>';
    echo '</tr>';
}

$conn->close();

?>
   </table>
    <br>
    <div style="text-align: center;">
        <form action="all-2.php" method="post">
            <input type="submit" value="回上一頁" style="display: inline-block;">
        </form>
    </div><br>
    <div style="text-align: center;">
        <form action="clean_cart.php" method="post">
            <input type="submit" value="清空購物車" style="display: inline-block;">
        </form>
    </div>
 
</body>
</html>