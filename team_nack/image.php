<?php
$dsn = 'mysql:dbname=tb210126db;host=localhost';
$user = 'tb-210126';
$password = 'A6xuzRBJG6';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$sql = 'SELECT * FROM images WHERE image_id = :image_id LIMIT 1';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':image_id', (int)$_GET['id'], PDO::PARAM_INT);
$stmt->execute();
$image = $stmt->fetch();
header('Content-type: ' . $image['image_type']);
echo $image['image_content'];
header('Location:toppage.php');

unset($pdo);

exit();
?>
