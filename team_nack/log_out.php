<!DOCTYPE html>
<html>
<head>
	<meta charset = 'UTF-8'>

</head>
<body>

<?php
    session_start();
    if(!isset($_SESSION["name"])){
        $no_login_url = "login.php";
        header("Location: {$no_login_url}");
        exit;
    }
?>


    <h1 align="center"> Cycle Couse Recommender</h1>




 <div align="center">
<p>ログアウトしました。</p>


        <hr>
        <p>ログイン画面</p>
        <form action="login.php">
            <input id="login" type="submit" value="ログイン">
        </form>
        
         <p>新規登録</p>
        <form action="newuser.php">
            <input id="newuser" type="submit" value="新規登録">
        
                </form>
        

 </div>
</body>
</html>