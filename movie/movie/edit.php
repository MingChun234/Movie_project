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
    <meta charset="UTF-8">
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

        .modal {
            display: none; /* 預設隱藏 */
            position: fixed; /* 保持在頂部 */
            z-index: 1; /* 位於其他內容之上 */
            padding-top: 100px; /* 位置 */
            left: 0;
            top: 0;
            width: 100%; /* 全寬 */
            height: 100%; /* 全高 */
            overflow: auto; /* 啟用滾動條 */
            background-color: rgb(0,0,0); /* 黑色背景 */
            background-color: rgba(0,0,0,0.4); /* 黑色背景，半透明 */
    }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
    }

/* 關閉按鈕 */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
    }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
    }
</style>
</head>
<body>
        <h1>這頁還沒用完，刪除跟更新都是 後續會自行完成</h1>
        <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="buy.php" method="post">
            <input type="hidden" name="id" id="id">
            <input type="text" name="name" id="name">
            <input type="date" name="date" id="date">
            <input type="time" name="time" id="time">
            <input type="number" name="number" id="number">
            <input type="number" name="price" id="price">
            <input type="submit" value="更新">
            </form>
        </div>
        </div>
        <?php
            $account_name = isset($_SESSION['account_name']) ? $_SESSION['account_name'] : '';
        ?>
            <div class="circle"></div>
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
            <div class="account-info">歡迎，帳號<?php echo $account_name; ?></div>           
        <script>
        // 獲取模態框
        var modal = document.getElementById("myModal");

        // 獲取關閉按鈕
        var span = document.getElementsByClassName("close")[0];

        // 當用戶點擊關閉按鈕，關閉模態框
        span.onclick = function() {
        modal.style.display = "none";
        }formfunction openModal(id, name, date, time, number, price) {
                document.getElementById('id').value = id;
                document.getElementById('name').value = name;
                document.getElementById('date').value = date;
                document.getElementById('time').value = time;
                document.getElementById('number').value = number;
                document.getElementById('price').value = price;
                modal.style.display = "block";
        }

        // 當用戶點擊模態框以外的地方，關閉模態框
        window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
        }

        // 打開模態框，並填充表單
        function openModal(id, name, date, time, number, price) {
        document.getElementById('id').value = id;
        document.getElementById('name').value = name;
        document.getElementById('date').value = date;
        document.getElementById('time').value = time;
        document.getElementById('number').value = number;
        document.getElementById('price').value = price;
        modal.style.display = "block";
}
        </script>
<?php
       
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            
            $name = $_POST['name'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            $number = $_POST['number'];
            $price = $_POST['price'];
            $account_name = $_SESSION['account_name'];
            $account_name = $conn->real_escape_string($account_name);
            $table_name = $account_name . "_cart";
            $id = $_POST['id']; // 獲取 URL 中的 ID
            
            // 從資料庫中獲取相應的資料
            $sql = "SELECT * FROM  $table_name WHERE id = $id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                

                $row = $result->fetch_assoc();
                echo '<form action="edit.php" method="post">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<input type="text" name="name" value="' . $row['name'] . '">';
                echo '<input type="date" name="date" value="' . $row['date'] . '">';
                echo '<input type="time" name="time" value="' . $row['time'] . '">';
                echo '<input type="number" name="number" value="' . $row['number'] . '">';
                echo '<input type="number" name="price" value="' . $row['price'] . '">';
                echo '<input type="submit" value="更新">';
                echo '</form>';

                $total = $row['number'] * $row['price'];
                echo "<td>" . $total . "</td>";

                // Add a hidden input field to pass the total value to the form submission
                echo '<input type="hidden" name="total" value="' . $total . '">';
            }
                 
                
             else {
                echo "找不到相應的資料";
            }
            
            echo '<button onclick="openModal(\'' . $row['id'] . '\', \'' . $row['name'] . '\', \'' . $row['date'] . '\', \'' . $row['time'] . '\', \'' . $row['number'] . '\', \'' . $row['price'] . '\')">編輯</button>';
            
}
$conn->close();
?>
    </table>
        <div style="text-align: center;">
            <form action="buy.php" method="post">
            <input type="submit" value="回上一頁" style="display: inline-block;">
        </form>
        </div>
</body>
</html>
