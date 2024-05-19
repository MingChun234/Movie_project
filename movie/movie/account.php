<html>
<head>
    <meta charset="UTF-8">
    <title>註冊帳號</title>
    <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #BBFFFF;
      margin: 0;
      padding: 20px;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    p {
      text-align: center;
      margin-bottom: 20px;
      color:rgb(0, 125, 0);
    }

    form {
      background-color: #ffffff;
      max-width: 400px;
      margin: 0 auto;
      padding: 40px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    input[type="submit"]{
        display: block;
        width:100%;
        padding: 10px;
        background-color: #CA8EC2;
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
  
      <form action="account(php).php" method="post" >
        <h1>註冊帳號</h1>
        <p>*帳密只能是英文或數字 長度在2-15之間*</p>
        <label for="name">帳號：</label>
        <input type="text" id="account_name" name="account_name" pattern="[A-Za-z0-9]{2,15}"  required>

        <label for="password">密碼：</label>
        <input type="password" id="password" name="password" pattern="[A-Za-z0-9]{2,15}"  required>
        <br><br><br>
        <input type="submit" value="註冊">
    </form>
    
    <form action="in.php" method="post">
        <input type="submit" value="返回登入">
    </form>
</body>
</html>