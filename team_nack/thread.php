<html lang="ja">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h1 id="midashi_1"> Cycle Course Recommender</h1>


//DB接続
<?php
$dsn = 'mysql:dbname=tb210133db;host=localhost';
$user = 'tb-210133';
$password = 'PHF7gy2jzx';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$sql = "CREATE TABLE IF NOT EXISTS images"
." ("
. "image_id INT( 5 ) NOT NULL AUTO_INCREMENT PRIMARY KEY,"
. "image_name VARCHAR( 256 ) NOT NULL ,"
. "image_type VARCHAR( 64 ) NOT NULL ,"
. "image_content mediumblob NOT NULL ,"
. "image_size int NOT NULL ,"
. "created_at DateTime"
.");";
$stmt = $pdo->query($sql);


//スレッドIDの取得
    $t_id = $_GET["threadId"];
    echo $t_id;
    if(!preg_match("/[0-9]/",$t_id)){
        echo "不正な値です<br>";
    }elseif(preg_match("/[0-9]/",$t_id)){
        $sql = 'select courseName from courseDB where courseId=:courseId';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':courseId', $t_id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt -> fetch();

        $t_com="🚲　".$t_id."　".$result[0]."　🚲";
    }else{
        echo "コースを選択してください<br>";
?>
<a href="toppage.php">トップページに戻る</a>
<?php
    }
?>

<!--スレッドのタイトル表示-->
    <h2><?php echo $t_com;?></h2>
    <br>
    <div class="image">
      <ul>
        <?php
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            // 画像を取得
          $sql = 'SELECT * FROM images ORDER BY created_at DESC';
          $stmt = $pdo->prepare($sql);
          $stmt->execute();
          $images = $stmt->fetchAll();
        }
         ?>
        <?php for($i = 0; $i < count($images); $i++): ?>
            <li class="media mt-5">
                <a href="#lightbox"data-toggle="modal" data-slide-to="<?= $i; ?>">
                    <img src="image.php?id=<?= $images[$i]['image_id']; ?>" width="100px" height="auto" class="mr-3">
                </a>
                <div class="media-body">
                    <a href="javascript:void(0);"
                        onclick="var ok = confirm('削除しますか？'); if (ok) location.href='delete.php?id=<?= $images[$i]['image_id']; ?>'">削除</a>
                </div>
            </li>
        <?php endfor; ?>
      </ul>

    </div>

    <br>
    <div>コメント</div>
<?php
//コメント投稿
    if(!empty($_GET["name"]) && !empty($_GET["comment"])){
        $name=htmlspecialchars($_GET["name"]);
        $comment = htmlspecialchars($_GET["comment"]);
        $userIp=getenv("REMOTE_ADDR");
        $date = date("Y/m/d G:i:s");

        $sql = $pdo -> prepare("INSERT INTO tb_02 (name, comment, date, threadId, userIp) VALUES (:name, :comment, :date, :threadId, :userIp)");
            $sql -> bindParam(':name', $name, PDO::PARAM_STR);
            $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
            $sql -> bindParam(':date', $date, PDO::PARAM_STR);
            $sql -> bindParam(':threadId', $t_id, PDO::PARAM_INT);
            $sql -> bindParam(':userIp', $userIp, PDO::PARAM_INT);
            $sql -> execute();
    }
    echo "<hr>";

//コメントの表示
    $sql = 'select*from tb_02 where threadId=:threadId';
    $stmt = $pdo -> prepare($sql);
    $stmt->bindParam(':threadId', $t_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt -> fetchAll();
    $i=1;
    foreach($result as $row){
        echo $i.":".$row['name'].":".$row['date']."<br>";
        echo $row['comment']."<br><br>";
        echo "<hr>";
        $i=$i+1;
    }
    unset($pdo);

?>
<form method="GET" action="thread.php">

    名前:<input type="text" name="name"><br>
    コメント<br>
    <textarea name="comment" rows="7" cols="70"></textarea><br>
    <input type="hidden" name="threadId" value=<?php echo $t_id;?>>
    <input type="submit" value="送信">
</form>
<hr>
<div class="col-md-4 pt-4 pl-4">
    <form method="post"  enctype="multipart/form-data" action="list123.php">
          <div class="form-group">
          <label>画像を選択</label>
          <input type="file" name="image" required>
      </div>
      <input type="hidden" name="threadId" value=<?php echo $t_id;?>>
      <button type="submit"  class="btn">保存</button>

  </form>
</div>


<a href="toppage.php">トップページに戻る</a>
<body>
</html>
