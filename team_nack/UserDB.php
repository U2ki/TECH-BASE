<?php
   $dsn = 'mysql:dbname=tb210133db;host=localhost';
    $user = 'tb-210133';
    $password = 'PHF7gy2jzx';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    //テーブル作成
    
    $sql = "CREATE TABLE IF NOT EXISTS UserDB2"
    ." ("
    . "userid INT AUTO_INCREMENT PRIMARY KEY,"
    . "name char(32),"
    . "email char(50),"
    ." pass char(32)"
    .");";
    $stmt = $pdo->query($sql);

    //テーブル表示
    $sql = 'select*from UserDB2';
    $stmt = $pdo -> query($sql);
    $result = $stmt -> fetchAll();
    foreach($result as $row){
        echo $row['userid'].",";
        echo $row['name'].",";
        echo $row['email'].",";
        echo $row['pass']."<br>";
        echo "<hr>";
    }    

?>