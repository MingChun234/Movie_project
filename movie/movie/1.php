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

$sql = "SELECT 電影場次, 場次時間 FROM 場次表 WHERE 電影場次 IN ('E1', 'E2', 'E3', 'E4', 'E5', 'E6', 'E7')";
$result = $conn->query($sql);

$images = ['多拉a夢.gif', '多拉美.gif']; 
$randomImage = $images[rand(0, count($images) - 1)]; 

?>

<html>
<head>
  <meta charset="UTF-8">
  <title>青春豬頭少年不會夢到紅書包女孩</title>
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
<form action="1(php).php" method="post" >
    <label for="seishun_buta_yaro">青春豬頭少年不會夢到紅書包女孩：</label>
    <label for="date"> 日期：</label>
    <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>"   required>
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
    <label > 購買數量:</label>
    <input type="number" id="number" name="number" value="0" min="0" max="30"  step="1" required>
    <br><br>
    <img src="1.png" alt="櫻島麻衣">
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