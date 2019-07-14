<!--mission_2 全てやってしまったぁ、、、-->

<!--Getは入力したものがURLに表示される-->

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>Form</title>
</head>
<body>

<?php

	
	$filename = "mission_3.txt";
	$pass = "nack";

	//設定
	echo "<br>パスワード：nack<br><br>";


	//投稿機能

	//フォーム内が空でない場合に以下を実行する
	if (isset($_POST["name"],$_POST["comment"])) {

	//入力データの受け取りを変数に代入
	$name = ($_POST["name"]);
	$comment = ($_POST["comment"]);
	//日付データを取得して変数に代入
	$now = date('Y/m/d H:i:s');
	$pw = ($_POST["passwd"]);


     // editNoがないときは新規投稿、ある場合は編集 ***ここで判断
     if (empty($_POST['edit_no'])) {

     // 以下、新規投稿機能
     //ファイルの存在がある場合は投稿番号+1、なかったら1を指定する

	if (file_exists($filename)) {

	//lineは配列
	$line = file($filename);

	//lineの総数より一つ前すなわち、送信した後にはすでに新しいのが入っている！
	if (count($line) >= 1) {
		$last_line = $line[count($line) - 1];
		
		//<>で区別して数字のところだけとる
		$line_num = explode('<>', $last_line)[0];
		//それに+１した数が次の番号になる◯
		$count = $line_num + 1;
	
	} else $count = 1;
}else $count = 1;

	if(empty($name)) $name = "名無しさん";

	//書き込む文字列を組み合わせた変数


	$newdata = $count."<>".$name."<>".$comment."<>".$now."<>".$pw. "\n";

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
	
	//ファイルを追記保存モードでオープンする
	$fp = fopen($filename, "a");

	fwrite($fp, $newdata);
	fclose($fp); 
	}
}
}
}else {

		// 以下編集機能
      	//入力データの受け取りを変数に代入
 		//編集実行機能

		//入力データの受け取りを変数に代入
          $edit_no = $_POST['edit_no'];

          //読み込んだファイルの中身を配列に格納する
          $edi_array = file($filename);

          //ファイルを書き込みモードでオープン＋中身を空に
          $fp = fopen($filename,"w");


		//配列の数だけループさせる
		for ($i=0; $i < count($edi_array); $i++) { 

			//explode関数でそれぞれの値を取得
			$edi_data = explode("<>", $edi_array[$i]);

			//投稿番号と編集番号が一致したら

			if ($edi_data[0] == $edit_no){

				//編集のフォームから送信された値と差し替えて上書き
                  fwrite($fp,$edit_no . "<>" . $name . "<>" . $comment . "<>" . $now .  "<>" . $pw ."\n");
              } else {

                  //一致しなかったところはそのまま書き込む
                  fwrite($fp,$edi_array[$i]);
			}
		}
		fclose($fp);
}
}

//削除機能
	//削除フォームの送信の有無で処理を分岐
	if (isset($_POST["delete"])){
		$del_pw = ($_POST["del_passwd"]);

	if(!empty($_POST["delete"])){

	//passwdがないときはecho、あるときは新規投稿・編集投稿
	if(empty($del_pw)){
		echo "<br>パスワードが入力されていません。<br><br>";
	}else if(!empty($del_pw)){

	if($del_pw != $pass) {
		echo "<br>パスワードが違います。<br><br>";
	}else{

		//入力データの受け取りを変数に代入
		$delete = ($_POST["delete"]);//削除したい番号

		//読み込んだファイルの中身を配列に格納する
		$del_con = file($filename); //配列

		$have_del = 0;

		//ファイルを書き込みモードでオープン＋中身を空に
		$fp = fopen($filename, "w");

		//配列の数だけループさせる
		for ($i=0; $i < count($del_con); $i++) { 

			//explode関数でそれぞれの値を取得
			$del_num = explode("<>", $del_con[$i]);

			//forで[0]すなわちそれぞれの番号が$delete番号と同じか照合
			if ($del_num[0] != $delete){

				//入力データのファイル書き込み
				fwrite($fp, $del_con[$i]);
			}else{ 
				$have_del = $del_num[0];
			}
		}
		if ($have_del != 0){
			echo $have_del."を削除しました<br><br>";
		}
		fclose($fp);
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
		echo "<br>パスワードが入力されていません。<br><br>";
	}else if(!empty($edi_pw)){

	if($edi_pw != $pass) {
		echo "<br>パスワードが違います。<br><br>";
	}else{

		//入力データの受け取りを変数に代入
		$edit = ($_POST["edit"]);//削除したい番号

		//読み込んだファイルの中身を配列に格納する
		$edi_con = file($filename); //配列
		$have_edi = 0;

		//配列の数だけループさせる
		for ($i=0; $i < count($edi_con); $i++) { 

			//explode関数でそれぞれの値を取得
			$edi_num = explode("<>", $edi_con[$i]);

			//forで[0]すなわちそれぞれの番号が$delete番号と同じか照合
			if ($edi_num[0] == $edit){

			//投稿番号と編集対象番号が一致したらその投稿の「名前」と「コメント」を取得

				$editnumber = $edi_num[0];
				$user = $edi_num[1];
				$text = $edi_num[2];
				//既存の投稿フォームに、上記で取得した「名前」と「コメント」の内容が既に入っている状態で表示させる
                  //formのvalue属性で対応
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
	//表示機能
	//読み込んだファイルの中身を配列に格納する


	$cnt = count($fop = file($filename));

	//取得したファイルデータを全て表示する（ループ処理）
	for ($i=0; $i < $cnt ; $i++) {
	//fopもexceptも配列になった！！！
	//explode関数でそれぞれの値を取得
	$cnt_ex = count($except = explode("<>",$fop[$i])) -1;

	//取得した値を表示する
	for ($j=0; $j < $cnt_ex; $j++) { 
		echo $except[$j]."\t";
	}
		echo "<br>";
	}
?>


</body>
</html>
