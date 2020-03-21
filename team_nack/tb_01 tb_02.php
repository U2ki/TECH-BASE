<?php
    $dsn = 'mysql:dbname=tb210133db;host=localhost';
    $user = 'tb-210133';
    $password = 'PHF7gy2jzx';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING)); 

    $sql = "CREATE TABLE IF NOT EXISTS tb_01"
    ." ("
    . "threadId INT AUTO_INCREMENT PRIMARY KEY,"
    . "threadName char(32),"
    ." threadDate datetime,"
    . "sendIp char(32)"
    .");";
    $stmt = $pdo->query($sql);

    $sql = "CREATE TABLE IF NOT EXISTS tb_02"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name char(32),"
    . "comment text,"
    . "date datetime,"
    . "threadId int,"
    . "userIp char(32)"
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