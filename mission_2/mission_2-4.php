<!--mission_2 全てやってしまったぁ、、、-->

<!--Getは入力したものがURLに表示される-->

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>Form</title>
</head>
<body>
<form method="POST" action="">
	名前：<input type="text" name="name">
	<br>
	<br>
	コメント：<textarea name="comment"></textarea>
	<br>
	<br>
	<input type="submit" value="送信">
</form>
</body>
</html>

<?php
	//notice回避成功！
	if(isset($_POST['comment'])){
    $comment = $_POST['comment'];
	} 
	if(isset($_POST['name'])){
	$name = $_POST['name'];
	}

	echo "<br>【投稿一覧】<br>";

	$filename = "mission_2-4.txt";

	//中身入っているかの確認
	if(empty($comment)){
		echo "<br>データが入力されていません。<br>";
	}else{
	$fp = fopen($filename, "a");

	if(empty($name)){
		$name = "[名無しさん]\n";
	}else $name = "[".$_POST['name']."]\n";

	
	echo "<br>-------投稿を受け取りました------<br>";

	fwrite($fp, $name . $comment . "\n\n");
	fclose($fp);
	}

	$fop = file('mission_2-4.txt');

	foreach ($fop as $value) {
		echo "<br>".$value ;
	}

?>