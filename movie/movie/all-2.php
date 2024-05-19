<!-- <?php
session_start();

        $servername = "localhost";
        $username = "root";
        $password = ""; 
        $dbname = "電影訂票系統";
        $conn = new mysqli($servername, $username , $password , $dbname );


        if ($conn->connect_error) {
            die("連接失敗: " . $conn->connect_error);
        }

$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']);

$images = ['多拉a夢.gif', '多拉美.gif']; 
$randomImage = $images[rand(0, count($images) - 1)]; 
?> -->
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>訂票</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #BBFFFF;
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

        .dropdown-menu {
            display: none;
            position: fixed;
            top: 50px;
            right: 10px;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-menu a {
            color: deeppink;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align:center
        }

        .dropdown-menu a:hover {background-color: #f1f1f1}

        .account-info {
            position: fixed;
            top: 17px;
            right: 70px; /* 根據您的需求調整這個值 */
            font-size: 16px; 
            color: #000; 
            font-weight: bold;
        }

        form {
            background-color: #ffffff;
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }  

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #45a049;
        }
    </style>
</head>

<body onclick="hideDropdown(event)">

    <form action="buy.php"> 
    
        <?php
            $account_name = $_SESSION['account_name']; 
            $account_name = $conn->real_escape_string($account_name); // 避免 SQL Injection
            if (isset($_POST['delete_account']) && $_POST['delete_account'] == 'true') {
                $sql = "DELETE FROM `account` WHERE account_name = $account_name";
                
            if ($conn->query($sql) === TRUE) {
                    echo "帳號已成功註銷";
            } else {
                    echo "錯誤: " . $conn->error;
            }
            $table_name = $account_name . "_cart";
            $delete_table = "DROP TABLE IF EXISTS `$table_name`";
            if ($conn->query($delete_table) === TRUE) {
                $message = "資料表已成功刪除";
            } else {
                $message = "刪除資料表失敗: " . $conn->error;
            }
        }
        $conn->close();
        ?>
        <div class="circle" onclick="event.stopPropagation(); toggleDropdown();"></div>
        <div id="dropdown" class="dropdown-menu" onclick="event.stopPropagation();">
            <a href="in.php">登出</a>
            <a href="buy.php">購物車</a>
            <a href="in.php" onclick="event.preventDefault(); deleteAccount();">註銷帳號</a>
        </div>
        <div class="account-info">歡迎，帳號<?php echo $account_name; ?></div>
        <h1>現正熱映</h1>
        <h3>一張票250元</h3>
        <input type="submit" value="購買紀錄">
    </form>
    <form action="1.php">
        <label for="seishun_buta_yaro">青春豬頭少年不會夢到紅書包女孩：</label>
        <a href="https://www.youtube.com/watch?v=umDhtH2NTls" target="_blank">
        <img src="1.png" alt="櫻島麻衣">
        </a>
        <input type="submit" value="購買">
    </form>

    <form action="2.php">
        <label for="aquaman">水行俠 失落王國：</label>
        <a href="https://www.youtube.com/watch?v=rvWUuaUsiW0" target="_blank">
        <img src="4.png" alt="水行俠">
        </a>
        <input type="submit" value="購買">
    </form>

    <form action="3.php">
        <label for="spy-family">spy family code white：</label>
        <a href="https://www.youtube.com/watch?v=EpUAso8ITVw" target="_blank">
        <img src="5.png" alt="spy-family">
        </a>
        <input type="submit" value="購買">
    </form>
    
    </form>
    
<script>
    var message = "<?php echo $message; ?>";
    if (message) {
        alert(message);
    }
    function toggleDropdown() {
        var dropdown = document.getElementById('dropdown');
            if (dropdown.style.display === "none") {
                    dropdown.style.display = "block";
        }   else {
                dropdown.style.display = "none";
        }
}
    function hideDropdown(event) {
        var dropdown = document.getElementById('dropdown');
        var circle = document.querySelector('.circle');
            if (event.target != dropdown && event.target != circle) {
                dropdown.style.display = 'none';
        }
    }
    function deleteAccount() {
        var confirmDelete = confirm("確定要註銷帳號?");
            if (confirmDelete) {
                // 如果用戶點擊 "是"，則發送 AJAX 請求來註銷帳號
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'all-2.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('delete_account=true');

                xhr.onload = function() {
            if (xhr.status === 200) {
                    alert('帳號已註銷');
                    window.location.href = 'in.php';
                }
            };
        } else {
        // 如果用戶點擊 "否"，則導向 all-2.php
        window.location.href = 'all-2.php';
    }
}

</script>

</body>

</html>


