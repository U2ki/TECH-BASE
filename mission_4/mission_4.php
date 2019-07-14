
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>Form</title>
</head>
<body>

<?php

	
	//データベース
	$dsn = 'mysql:dbname=tb210063db;host=localhost';
	$d_user = 'tb-210063';
	$password = 'yfgL7tXREY';
	$pdo = new PDO($dsn, $d_user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

	//テーブル作成
	$sql = "CREATE TABLE IF NOT EXISTS tbtest"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(32),"
	. "comment TEXT"
	.");";
	$stmt = $pdo->query($sql);

	//テーブル一覧を表示
	$sql ='SHOW TABLES';
	$result = $pdo -> query($sql);
	foreach ($result as $row){
		echo $row[0];
		echo '<br>';
	}
	echo "<hr>";

	//テーブルの中身を確認
	$sql ='SHOW CREATE TABLE tbtest';
	$result = $pdo -> query($sql);
	foreach ($result as $row){
		echo $row[1];
	}
	echo "<hr>";
	

	//テーブルにデータを入力
	//bindParamの引数（:nameなど）は4-2でどんな名前のカラムを設定したかで変える必要がある。
	//なお、意図通り入力が出来ているかどうかは4-6にて確認できる。
	
	/*$sql = $pdo -> prepare("INSERT INTO tbtest (name, comment) VALUES (:name, :comment)");
	$sql -> bindParam(':name', $name, PDO::PARAM_STR);
	$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
	$name = 'LLL';
	$comment = 'LR'; //好きな名前、好きな言葉は自分で決めること
	$sql -> execute();*/


	//テーブルの中身を編集
	$id = 1; //変更する投稿番号
	$name = "MAO";
	$comment = "FFFFF"; //変更したい名前、変更したいコメントは自分で決めること
	$sql = 'update tbtest set name=:name,comment=:comment where id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();

	$id = 6;
	$sql = 'delete from tbtest where id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();

	//入力したデータを表示
	//$rowの添字（[ ]内）は4-2でどんな名前のカラムを設定したかで変える必要がある。
	$sql = 'SELECT * FROM tbtest';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].'<br>';
	echo "<hr>";
	}
?>
</body>
</html>
