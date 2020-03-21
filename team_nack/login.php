<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="UTF-8">
        <title>ログイン画面</title>
    
        <link rel="stylesheet" href="css/login.css">
    </head>
    <body>
  
    <h1 align="center">Cycle Cource Recommender</h1>

    <form id="loginForm" name="loginForm" action="" method="post">
        <div class="form-item"align="center">
            <input type="text" name="name"  placeholder="ユーザー名" style="text-align:center">
            <P></P>
            <input type="email"name="email" placeholder="メールアドレス" style="text-align:center">
            <P></P>
            <input type="password" name="pass" placeholder="パスワード" style="text-align:center">
        </div>
        <div class="button-panel"align="center">
            <p></p>
            <input type="submit" class="button" name="login" value="ログイン">
            <p></p>
            <p></p>
        </div>
    </form>
    <br>
    <div class="newbutton-panel"align="center">
        <hr>
        <p></p>
        <p>新規登録はこちら</p>
        <p></p>
        <form action="newuser.php">
            <input id="newuser" type="submit"class="button" value="新規登録">
        </form>
    </div>
    

<?php
    session_start();
    $error_message = "";

//DB接続
    $dsn = 'mysql:dbname=tb210133db;host=localhost';
    $user = 'tb-210133';
    $password = 'PHF7gy2jzx';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

//ログイン機能
    if(isset($_POST["login"])){
        if(!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["pass"])){
            $name = $_POST["name"];
            $email= $_POST["email"];
            $pass = $_POST["pass"];
            $check = 0;
            
           
        //管理者ログイン
            $manage_name = "test";
            $manage_mail = "test@gmail.com";
            $manage_pass = "000";
            $manage_url = "management.php";
            if($name == $manage_name){
                if($email == $manage_mail){
                if($pass == $manage_pass){
                   header("Location:{$manage_url}"); 
                }
            }
            } 
            
        //ユーザー検索
            $sql = 'select * from UserDB2';
            $stmt = $pdo -> query($sql);
            $result = $stmt -> fetchAll();
            foreach($result as $row){
                if($name == $row["name"] && $email ==  $row["email"] && $pass == $row["pass"]){
                //ログイン
                    $_SESSION["name"] = $name;
                    $login_url = "toppage.php";
                    header("Location:{$login_url}");
                    $check = 1;
                    exit;
                }
            }
            if($check == 0){
                $error_message = "ユーザー名またはメールアドレスまたはパスワードが間違っています<br>";
            }
        }else{
            $error_message = "ユーザー名またはメールアドレスまたはパスワードが空欄です<br>";
        }
        echo $error_message;
    }
?>

  </body>
</html>