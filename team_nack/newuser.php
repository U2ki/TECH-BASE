<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>新規登録</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="css/newuser.css">
    </head>
    
    <body>
    <h1 align="center"> Cycle Course Recommender</h1>
    <div align="center">
<?php

//DB接続
$dsn = 'mysql:dbname=tb210133db;host=localhost';
$user = 'tb-210133';
$password = 'PHF7gy2jzx';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

//新規ユーザー登録機能
    if(isset($_POST["submit"])){
        if(!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["pass"])){
            $check = 0;
            $name = $_POST["name"];
            $email = $_POST["email"];
            $pass = $_POST["pass"];
    
        //ユーザー名一致検索
            $sql = 'select name from UserDB2';
            $stmt = $pdo -> query($sql);
            $result = $stmt -> fetchAll();
            foreach($result as $row){
                if($name == $row){
                    $check = 1;
                    echo "このユーザー名は既に使われています"."<br>";
                }
                if($email == $row){
                    $check = 1;
                    echo "このメールアドレスは既に使われています"."<br>";
            }
    }
        //ユーザー登録
            if($check == 0){
                $sql = $pdo -> prepare("INSERT INTO UserDB2 (name,email,pass) VALUES (:name,:email,:pass)");
                $sql -> bindParam(':name', $name, PDO::PARAM_STR);
                $sql -> bindParam(':email', $email, PDO::PARAM_STR);
                $sql -> bindParam(':pass', $pass, PDO::PARAM_STR);
                $sql -> execute();
                echo "登録しました"."<br>";
            }
        }else{
            echo "ユーザー名またはメールアドレスまたはパスワードが空欄です"."<br>";
        }
    }
?>
    
    <form action="" method="post">
        <br>
        <h2 align="center">新規登録</h2>
        <br>
        <div class="form-item"align="center">
        <input type="text" name="name" placeholder="ユーザー名" style="text-align:center"><br>
        <input type="email" name="email" placeholder="メールアドレス" style="text-align:center"><br>
        <input type="password" name="pass" placeholder="パスワード" style="text-align:center"><br>
        </div>
        <input type="submit" class="button" name="submit" value="登録">
        <br>
        <br>
    </form>
    </div>
    <hr>
    <div align="center">
        <p>ログインはこちら</p>
        <form action="login.php">
            <input id="login" type="submit" value="ログイン">
        </form>
   
    </div>
  
    </body>
</html>