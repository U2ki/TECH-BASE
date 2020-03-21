<?php
    $dsn = 'mysql:dbname=tb210133db;host=localhost';
    $user = 'tb-210133';
    $password = 'PHF7gy2jzx';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)); 

    $sql = "CREATE TABLE IF NOT EXISTS courseDB"
    ." ("
    . "courseId INT AUTO_INCREMENT PRIMARY KEY,"
    . "courseName char(32),"
    . "start char(32),"
    . "goal char(32),"
    . "distance int,"
    . "difficulty int,"
    . "Ip char(32)"
    .");";
    $stmt = $pdo->query($sql);

    $sql ='SHOW TABLES';
    $result = $pdo -> query($sql);
    foreach ($result as $row){
    echo $row[0];
    echo '<br>';
    }
    echo "<hr>";
?>