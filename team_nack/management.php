<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Management</title>
    <link rel="stylesheet" type="text/css" href="css/manage.css">
</head>
<body>
    <h1 id="midashi_1"> Management Site</h1>


<?php
//DB接続
    $dsn = 'mysql:dbname=tb210133db;host=localhost';
    $user = 'tb-210133';
    $password = 'PHF7gy2jzx';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)); 

    $errorMessage = "";

    //スレッド削除機能
    if (isset($_POST["del_id"])){

        //入力データの受け取りを変数に代入
        $del_id = ($_POST["del_id"]);//削除したい番号

    if(empty($del_id)){
        $errorMessage = "削除実行に失敗しました。";
    }else if(!empty($del_id)){

    //削除実行
    $threadId = $del_id;
    $sql = 'delete from courseDB where threadId=:threadId';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':courseId', $threadId, PDO::PARAM_INT);
    $errorMessage = "削除しました。";
    $stmt->execute();
    }
    }


    //コメント削除機能
    if (isset($_POST["del_id"])){

        //入力データの受け取りを変数に代入
        $del_id = ($_POST["del_id"]);//削除したい番号

    if(empty($del_id)){
        $errorMessage = "削除実行に失敗しました。";
    }else if(!empty($del_id)){

    //削除実行
    $threadId = $del_id;
    $sql = 'delete from tb_02 where threadId=:threadId';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':threadId', $threadId, PDO::PARAM_INT);
    $errorMessage = "削除しました。";
    $stmt->execute();
    }
    }


     //ユーザ削除機能
    if (isset($_POST["del_id"])){

        //入力データの受け取りを変数に代入
        $del_id = ($_POST["del_id"]);//削除したい番号

    if(empty($del_id)){
        $errorMessage = "削除実行に失敗しました。";
    }else if(!empty($del_id)){

    //削除実行
    $userid = $del_id;
    $sql = 'delete from UserDB2 where userid=:userid';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
    $errorMessage = "削除しました。";
    $stmt->execute();
    }
    }
?>

    <div>
        <p style="float: left; color:#ff0000;">
        <?php echo $errorMessage; ?></p>
    </div>

    <br>
    <br>
    <br>

<!--上のボタン-->
<div class="cp_qa">
<input id="cp_conttab1" class="tab" type="radio" name="tabs" checked>
<label for="cp_conttab1" class="cp_tabitem">スレッドの削除</label>
<input id="cp_conttab2" class="tab" type="radio" name="tabs">
<label for="cp_conttab2" class="cp_tabitem">コメントの削除</label>
<input id="cp_conttab3" class="tab" type="radio" name="tabs">
<label for="cp_conttab3" class="cp_tabitem">ユーザの削除</label>

<div id="cp_content1">
<div class="cp_qain">
<div class="cp_actab">


<!--ひとくくり↓-->

<div class="cp_qq">

<h2>スレッドの削除</h2>

<!--中身-->
<?php

//スレッドの表示
$sql = 'SELECT * FROM courseDB';
$stmt = $pdo->query($sql);
$result = $stmt -> fetchAll(); 
foreach ($result as $row) {
    ?>
                <p>
                <?php
                echo "courseId:".$row['courseId']."<br>";
                echo "courseName:".$row['courseName']."<br>";
                echo "start:".$row['start']."<br>";
                echo "goal:".$row['goal']."<br>";
                echo "distance:".$row['distance']."<br>";
                echo "difficulty:".$row['difficulty']."<br>";
                echo "Ip:".$row['Ip']."<br>";
                ?>
         <form name="" method="POST" action="">
                <input type="hidden" name="del_id" value=" <?=$row['threadId']?> ">
                <input type="submit" value="削除" class="button_del">
        </form>
        </p>
    <?php 
    } ?>

</div>
<!--ひとくくり↑-->

</div>
</div>
</div>
<!--ここまで↑-->

<!--ここから↓-->
<div id="cp_content2">
<div class="cp_qain">
<div class="cp_actab">

<!--ひとくくり↓-->

<div class="cp_qq">

<h2>コメントの削除</h2>
<!--中身-->
<?php

//コメントの表示
$sql = 'SELECT * FROM tb_02';
$stmt = $pdo->query($sql);
$result = $stmt -> fetchAll(); 
foreach ($result as $row) {
    ?>
                <p>
                <?php
                echo "id:".$row['id']."<br>";
                echo "threadId:".$row['threadId']."<br>";
                echo "userIp:".$row['userIp']."<br>";
                echo "date:".$row['date']."<br>";
                echo "name:".$row['name']."<br>";
                echo "comment:".$row['comment']."<br>";
                ?>
         <form name="" method="POST" action="">
                <input type="hidden" name="del_id" value=" <?=$row['threadId']?> ">
                <input type="submit" value="削除" class="button_del">
        </form>
        </p>
    <?php 
    } ?>

</div>
<!--ひとくくり↑-->

</div>
</div>
</div>
<!--ここまで↑-->


<!--ここから↓-->
<div id="cp_content3">
<div class="cp_qain">
<div class="cp_actab">

<!--ひとくくり↓-->

<div class="cp_qq">

<h2>ユーザの削除</h2>
<!--中身-->

<?php

//ユーザの表示
$sql = 'SELECT * FROM UserDB2';
$stmt = $pdo->query($sql);
$result = $stmt -> fetchAll(); 
foreach ($result as $row) {
    ?>
                <p>
                <?php
                echo "userid".$row['userid']."<br>";
                echo "name:".$row['name']."<br>";
                echo "email:".$row['email']."<br>";
                echo "pass:".$row['pass']."<br>";
                ?>
         <form name="" method="POST" action="">
                <input type="hidden" name="del_id" value=" <?=$row['userid']?> ">
                <input type="submit" value="削除" class="button_del">
        </form>
        </p>
    <?php 
    } ?>

</div>
<!--ひとくくり↑-->

</div>
</div>
</div>
<!--ここまで↑-->
</div>

<hr>
<a href="toppage.php">トップページに戻る</a>
</body>
</html>