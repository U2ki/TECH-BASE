<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>toppage</title>
    <link rel="stylesheet"  type="text/css" href="css/toppage.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>
<body>
<?php
    session_start();
    if(!isset($_SESSION["name"])){
        $no_login_url = "login.php";
        header("Location: {$no_login_url}");
        exit;
    }
?>
    <div class="screen">
    <h1 id="midashi_1"> Cycle Course Recommender</h1>
    <h2>Welcome</h2>
    <br>
    <br>
    <h2>◆見たいコースの番号をクリックしてください<h2>
        <br><br><br><br><br><br>
    <h3>(コース一覧)<h3>
    <hr>
    <br>

<?php
$dsn = 'mysql:dbname=tb210133db;host=localhost';
$user = 'tb-210133';
$password = 'PHF7gy2jzx';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

//IPアドレスの取得
    $ip=getenv("REMOTE_ADDR");


//コース表示
    $sql = 'select*from courseDB';
    $stmt = $pdo -> query($sql);
    $result = $stmt -> fetchAll();
    foreach($result as $r){
?>
    <ul>
        <li><a href="thread.php?threadId=<?php echo $r['courseId']?>"><?php echo $r['courseName']?></a></li><br>
    </ul>
<?php 
    }
?>

    <form method="get" action="toppage.php">
        <br>
        <hr>
        <br>
    <a href="course_up.php">コースの登録はこちら</a>
      <br>
     <hr>
    </form>
    <br>
    <a href="search.php">検索はこちら</a>
    <br>
    <br>
    <hr>
<a href="log_out.php">ログアウト</a>
<hr>

</body>
</html>