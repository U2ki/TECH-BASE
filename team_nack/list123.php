<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>AAA</title>
  </head>
  <body>
    <?php
    $dsn = 'mysql:dbname=tb210126db;host=localhost';
    $user = 'tb-210126';
    $password = 'A6xuzRBJG6';
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




    $t_id = $_POST["threadId"];
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
      // 画像を取得
      $sql = 'SELECT * FROM images ORDER BY created_at DESC';
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $images = $stmt->fetchAll();

    } else {
      // 画像を保存
      if (!empty($_FILES['image']['name'])) {
        $name = $_FILES['image']['name'];
        $type = $_FILES['image']['type'];
        $content = file_get_contents($_FILES['image']['tmp_name']);
        $size = $_FILES['image']['size'];
        $sql = 'INSERT INTO images(image_name, image_type, image_content, image_size, created_at)
        VALUES (:image_name, :image_type, :image_content, :image_size, now())';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':image_name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':image_type', $type, PDO::PARAM_STR);
        $stmt->bindValue(':image_content', $content, PDO::PARAM_STR);
        $stmt->bindValue(':image_size', $size, PDO::PARAM_INT);
        $stmt->execute();
        echo "保存しました。";
      }
      unset($pdo);
      // header('Location:toppage.php');
      header('Location:toppage.php');

      exit();
    }
    // unset($pdo);


  ?>
<a href="toppage.php">戻る</a>
    <!-- <a href="thread.php?threadId=<?php echo $t_id; ?>">スレッドに戻る</a><br> -->
    <h1>aaaa</h1>
  </body>
</html>
