<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>Form</title>
</head>
<body>

	<?php
	echo "<br>パスワード：nack<br><br>";
	?>

<?php

	//設定
	$pass = "nack";


	//データベース
	$dsn = 'mysql:dbname=********db;host=localhost';
	$d_user = '*********';
	$password = '**********';
	$pdo = new PDO($dsn, $d_user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	//テーブル作成
	$sql = "CREATE TABLE IF NOT EXISTS mission5"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(32),"
	. "comment TEXT,"
	. "now DATETIME,"
	. "pw char(32)"
	.");";
	$stmt = $pdo->query($sql);



	 #データベースへの登録
	//フォーム内が空でない場合に以下を実行する
	if (isset($_POST["name"],$_POST["comment"])) {

	$name = ($_POST["name"]);
	$comment = ($_POST["comment"]);
	$pw = ($_POST["passwd"]);

	$delete = ($_POST["delete"]);

	     // editNoがないときは新規投稿、ある場合は編集 ***ここで判断
     if (empty($_POST['edit_no'])) {

	if(empty($comment)){
		echo "<br>コメントが入力されていません。<br><br>";
	}else if(!empty($comment)){

	//passwdがないときはecho、あるときは新規投稿・編集投稿
	if(empty($pw)){
		echo "<br>パスワードが入力されていません。<br><br>";
	}else if(!empty($pw)){

	if($pw != $pass) {
		echo "<br>パスワードが違います。<br><br>";
	}else{
  	//テーブルにデータを入力
	$sql = $pdo -> prepare("INSERT INTO mission5 (name, comment,now,pw) VALUES (:name, :comment, :now, :pw)");
	$sql -> bindParam(':name', $name, PDO::PARAM_STR);
	$sql -> bindParam(':now', $now, PDO::PARAM_STR);
	$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
	$sql -> bindParam(':pw', $pw, PDO::PARAM_STR);

	if(empty($name)){
		$name = "名無しさん";
	}else $name = ($_POST["name"]);

	$comment = ($_POST["comment"]);
	$now = date('Y/m/d H:i:s');
	$pw = ($_POST["passwd"]);
	$sql -> execute();
    }
}
}
}else{

	// 以下編集機能
      	//入力データの受け取りを変数に代入
 		//編集実行機能

		//入力データの受け取りを変数に代入
    $edit_no = $_POST['edit_no'];

    $id = ($_POST["edit_no"]); //変更する投稿番号
	$name = ($_POST["name"]);
	$comment = ($_POST["comment"]); 
	$now = date('Y/m/d H:i:s');
	$sql = 'update mission5 set name=:name,comment=:comment,now=:now where id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
	$stmt->bindParam(':now', $now, PDO::PARAM_STR);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
} 
}




     //削除機能
	//削除フォームの送信の有無で処理を分岐
	if (isset($_POST["delete"])){
		$del_pw = ($_POST["del_passwd"]);

	if(!empty($_POST["delete"])){

	//passwdがないときはecho、あるときは新規投稿・編集投稿
	if(empty($del_pw)){
		echo "<br>パスワードが入力されていません。<br><br><br>";
	}else if(!empty($del_pw)){

	if($del_pw != $pass) {
		echo "<br>パスワードが違います。<br><br><br>";
	}else{

		//入力データの受け取りを変数に代入
		$delete = ($_POST["delete"]);//削除したい番号

	//削除
	$id = $delete;
	$sql = 'delete from mission5 where id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();

	}
	}
	}
	}

	
	//編集機能

	//編集フォームの送信の有無で処理を分岐
	if (isset($_POST["edit"])){

	$edi_pw = ($_POST["edi_passwd"]);

	if(!empty($_POST["edit"])){

	//passwdがないときはecho、あるときは新規投稿・編集投稿
	if(empty($edi_pw)){
		echo "<br>パスワードが入力されていません。<br><br><br>";
	}else if(!empty($edi_pw)){

	if($edi_pw != $pass) {
		echo "<br>パスワードが違います。<br><br><br>";
	}else{

		//入力データの受け取りを変数に代入
		$edit = ($_POST["edit"]);//編集したい番号

		// データの読み込み
		$sql = 'SELECT * FROM mission5 ';
		$stmt = $pdo -> query($sql); //!!!
		$result = $stmt -> fetchAll(); //!!!
		
		foreach ($result as $row) {
			if($row['id'] == $edit){
				$editnumber = $row['id'];
				$user = $row['name'];
				$text = $row['comment'];
			}
		}

	}
	}
	}
	}
	
	?>


    <form method="POST" action="">
	<input type="text" name="name" placeholder="名前" value="<?php if(isset($user)) {echo $user;} ?>">
	<br>
	<input type="text" name="comment" placeholder="コメントを入力" value="<?php if(isset($text)) {echo $text;} ?>">

	<input type="hidden" name="edit_no" value="<?php if(isset($editnumber)) {echo $editnumber;} ?>">
	<br>
	<input type="text" name="passwd" placeholder="パスワード">
	<input type="submit" value="送信">
	<br>
	<br>
	<input type="text" name="delete" placeholder="削除したい番号を入力">
	<br>
	<input type="text" name="del_passwd" placeholder="パスワード">
	<input type="submit" value="削除">
	<br>
	<br>
	<input type="text" name="edit" placeholder="編集したい番号を入力">
	<br>
	<input type="text" name="edi_passwd" placeholder="パスワード">
	<input type="submit" value="編集">
	<br>
	<br>	
	<br>
</form>


	<?php
	//入力したデータを表示
	//$rowの添字（[ ]内）は4-2でどんな名前のカラムを設定したかで変える必要がある。
	$sql = 'SELECT * FROM mission5';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['id']."\t";
		echo $row['name']."\t";
		echo $row['now'].'<br>';
		echo $row['comment'].'<br>';
	echo "<hr>";
	}



    ?>



</body>
</html>