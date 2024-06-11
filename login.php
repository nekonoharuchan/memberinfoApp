<?php

//接続
$dsn = "mysql:host=localhost; dbname=memberapp; charset=utf8";
$user = "testuser";
$pass = "testpass";

try{
    $dbh = new PDO($dsn, $user, $pass);
    login();
}catch (PDOException $e){
    echo " エラー内容：" . $e->getMessage();
}

//////////////////////////////////////////////////////

function login(){
    // データ受け取り
    $name = $_POST['name'];
    $pass = $_POST['pass'];
    global $dbh;

    $sql = <<<sql
    select pass from user where name = ?;
sql;
    //↑書き換え
    $stmt = $dbh -> prepare($sql);
    $stmt -> bindParam(1, $name);
    $stmt -> execute();

    while($row = $stmt -> fetch()){
        $dbpass = $row['pass'];
    }

    // 管理用パスワード
    if($dbpass === "admin"){
        header('location:administrator.php');
    }elseif($dbpass === $pass){
        header('location:contact.html');
    }
    else{
        header('location:error.php');
    }
}