<?php
$dsn = 'mysql:dbname=tb210126db;host=localhost';
$user = 'tb-210126';
$password = 'A6xuzRBJG6';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));


$sql = 'DELETE FROM images WHERE image_id = :image_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':image_id', (int)$_GET['id'], PDO::PARAM_INT);
$stmt->execute();
header('Location:toppage.php');
unset($pdo);
exit();
?>
