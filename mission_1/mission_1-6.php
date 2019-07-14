<?php
$this_year = 2019;
$start = 2000;

for ($i = $start; $i <= $this_year ; $i = $i+4) { 
	echo $i."<br>";
}
?>

<br>
<br>

<?php
 $siritori = array("しりとり","りんご","ごりら","らっぱ","ぱんだ");
 echo $siritori[2]."<br>";

?>

<br>
<br>

<?php
  $anki = "";
  //$siritori は　(2)の宣言をそのまま利用
  foreach ($siritori as $word) {
  	$anki = $anki . $word;
  	echo $anki."<br>";
  }
?>