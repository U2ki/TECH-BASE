<?php?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <h1>ログイン</h1>
        <form id="loginForm" name="loginForm" action="" method="POST">
             
              <!--  <div><font color="#ff0000">
                <?php //echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>-->


                <input type="text" class="log_box" name="mail" placeholder="メールアドレス">
                <!-- 上の中に本来 value="<?php // if (!empty($_POST["mail"])) {echo htmlspecialchars($_POST["mail"], ENT_QUOTES);} ?>" -->
                <br>
                <input type="password" class="log_box" name="password" value="" placeholder="パスワード">
                <br>
                <input type="submit" id="login" name="login" value="ログイン">
        </form>
        <br>
        <br>
        <br>
        <hr>
        <br>
        <p>まだ登録してない方はこちらから</p>
        <form action="signUp.php">
                <input id="sign_up" type="submit" value="新規登録">
        </form>
    </body>
</html>