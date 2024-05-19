<?php
session_start();

$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']);

$servername = "localhost";
$username = "root";
$dbpassword = "";
$dbname = "電影訂票系統";

$conn = new mysqli($servername, $username, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT 電影場次, 場次時間 FROM 場次表 WHERE 電影場次 IN ('S1', 'S2', 'S3', 'S4', 'S5', 'S6', 'S7')";
$result = $conn->query($sql);

$images = ['多拉a夢.gif', '多拉美.gif']; 
$randomImage = $images[rand(0, count($images) - 1)];

?>

<html>
<head>
  <meta charset="UTF-8">
  <title>spy family code white</title>
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

    label {
      display: block;
      margin-bottom: 10px;
    }

    input[type="number"] {
      width: 30%;

    }

    select {
      width:30%
    }

    input[type=date]{
      width:30%;
    }

    input[type="submit"] {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #4CAF50;
      color: #ffffff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    img {
      max-width: 100%;
      height: auto;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
<form action="3(php).php" method="post">
    <?php
        $account_name = $_SESSION['account_name']; 
        $account_name = $conn->real_escape_string($account_name); // 避免 SQL Injection
    ?>
    <div class="circle"></div>
    <div class="account-info">歡迎，帳號<?php echo $account_name; ?></div>
    <label for="spy-family">spy family code white：</label>  
    <label for="date"> 日期：</label>
    <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>"  required>
    <br><br>
    <label for="time">場次時間：</label>
    <select id="time" name="time" required>
    <option value="">請選擇</option>
    <?php
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['電影場次'] . ' - ' . $row['場次時間'] . '">' . $row['電影場次'] . ' - ' . $row['場次時間'] . '</option>';
      }
    } else {
      echo "No results";
    }
    $conn->close();
    ?>
    </select><br><br>
    <label> 購買數量：</label>
    <input type="number" id="number" name="number" value="0" min="0"   max="30"  step="1" required>
    <br><br>
    <img src="5.png" alt="spy-family">
    <input type="submit" value="訂票">
    </form>
    <form action="all-2.php">
    <input type="submit" value="回到上一頁">
    </form>
    <script>
        var message = "<?php echo $message; ?>";
        if (message) {
        alert(message);
    }
    </script>
</body>
</html>