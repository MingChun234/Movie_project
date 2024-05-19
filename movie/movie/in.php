<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>登入</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color:#BBFFFF;
      margin: 0;
      padding: 200px;
    }

    form {
      background-color: #ffffff;
      max-width: 400px;
      margin: 0 auto;
      padding: 50px;
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

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    input[type="submit"] {
      display: block;
      width: 100%;
      padding: 10px;
      background-color:	#CA8EC2;
      color: #ffffff;
      border: none;
      border-radius:10px ;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      color: black;
      background-color: #CA8EC2;
      width:100%;
    }

  </style>
</head>
<body>

  
  <form action="in(php).php" method="post">
      <h1>登入</h1>
      <label for="name">帳號：</label>
      <input type="text" id="account_name" name="account_name" pattern="[A-Za-z0-9]{2,15}" required>

      <label for="password">密碼：</label>
      <input type="password" id="password" name="password" pattern="[A-Za-z0-9]{2,15}" required>
      <br><br><br>
      <input type="submit" value="登入">
  </form>

  <form action="account.php" method="post">
      <input type="submit" value="註冊">
  </form>

</body>
</html>