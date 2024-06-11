<?php

//接続
$dsn = "mysql:host=localhost; dbname=memberapp; charset=utf8";
$user = "testuser";
$pass = "testpass";

try{
    $dbh = new PDO($dsn, $user, $pass);
    insert();
}catch (PDOException $e){
    echo " エラー内容：" . $e->getMessage();
}

//////////////////////////////////////////////////////

function insert(){
    // データ受け取り
    global $dbh;
    global $_POST;

    $sql = <<<sql
    insert into member (member_id,name_s,name_m,name_s_kn,name_m_kn,email,position,address,tel,birthday,gender,joincom,department,comment) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?);
sql;
    $stmt = $dbh -> prepare($sql);//実行を一時停止中

    $stmt -> bindParam(1,$_POST["id"]);
    $stmt -> bindParam(2,$_POST["name_s"]);
    $stmt -> bindParam(3,$_POST["name_m"]);
    $stmt -> bindParam(4,$_POST["name_s_kn"]);
    $stmt -> bindParam(5,$_POST["name_m_kn"]);
    $stmt -> bindParam(6,$_POST["email"]);
    $stmt -> bindParam(7,$_POST["position"]);
    $stmt -> bindParam(8,$_POST["address"]);
    $stmt -> bindParam(9,$_POST["tel"]);
    $stmt -> bindParam(10,$_POST["birthday"]);
    $stmt -> bindParam(11,$_POST["gender"]);
    $stmt -> bindParam(12,$_POST["join"]);
    $stmt -> bindParam(13,$_POST["department"]);
    $stmt -> bindParam(14,$_POST["comment"]);
    //実行
    $stmt -> execute();

    // 完了画面にリンク
        header('location:comp.php');
        
        // header('location:error.php');
}