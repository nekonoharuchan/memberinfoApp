<?php

$dsn = "mysql:host=localhost; dbname=memberapp; charset=utf8";
$user = "testuser";
$pass = "testpass";

//データ受け取り
$origin =[];

if(isset($_POST)){
    $origin += $_POST;
}

foreach($origin as $key => $value){
    $mb_code = mb_detect_encoding($value);
    $value = mb_convert_encoding($value, "UTF-8", $mb_code);

    $value = htmlentities($value, ENT_QUOTES, "UTF-8");

    $input[$key] = $value;
}

try{
    $dbh = new PDO($dsn, $user, $pass);
    if(isset($input["mode"]) && $input["mode"] === "delete"){
        delete();
    }elseif(isset($input["mode"]) && $input["mode"] === "update"){
        update();
    }
}catch (PDOException $e){
    echo " エラー内容：" . $e->getMessage();
}

// 一覧表示機能
function display(){

    global $dbh;

    $sql = <<<sql
    select * from member where flag = 1;
    sql;
    $stmt = $dbh -> prepare($sql);
    $stmt -> execute();

        //テンプレート
        $tmp = <<<tmp
        <tr>
            <td>!社員ID!</td>
            <td>!名前姓!</td>
            <td>!名前名!</td>
            <td>!フリガナ姓!</td>
            <td>!フリガナ名!</td>
            <td>!メールアドレス!</td>
            <td>!役職!</td>
            <td>!住所!</td>
            <td>!電話番号!</td>
            <td>!生年月日!</td>
            <td>!性別!</td>
            <td>!入社日!</td>
            <td>!所属部署!</td>
            <td>!備考特記事項!</td>
            <form action="administrator.php" method="post">
                <td><input class="btn edit_btn" type="submit" value="編集"></td>
                <input type = "hidden" name = "id" value = "!id!">
                <input type = "hidden" name = "mode" value = "edit">
            </form>
            <form action="administrator.php" method="post">
                <td><input class="btn delete_btn" type="submit" value="削除"></td>
                <input type = "hidden" name = "id" value = "!id!">
                <input type = "hidden" name = "mode" value = "delete">
            </form>
        </tr>
tmp;

    echo  tmpl($stmt, $tmp);
}

// 検索機能
function search(){
    global $dbh;
    global $input;

    $sql = <<<sql
    select * from member where flag = 1 and (
        name_s like ? or
        member_id like ? or
        name_s like ? or
        name_m like ? or
        name_s_kn like ? or
        name_m_kn like ? or
        email like ? or
        position like ? or
        address like ? or
        tel like ? or
        birthday like ? or
        gender like ? or
        joincom like ? or
        department like ? or
        comment like ?);
    sql;
    
    $stmt = $dbh -> prepare($sql);
    $input["search"] = "%".$input["search"]."%";
    for($i = 1; $i < 16; $i++){
        $stmt -> bindParam($i,$input["search"]);
    }
    $stmt -> execute();

    // foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $key=>$value){
    //     echo $value["member_id"];
    // }

    $search_format = <<<format
    <h3>検索結果</h3>
    <div class="table_box">
        <table>
            <tr>
                <th>社員ID</th>
                <th>名前(姓)</th>
                <th>名前(名)</th>
                <th>フリガナ(姓)</th>
                <th>フリガナ(名)</th>
                <th>メールアドレス</th>
                <th>役職</th>
                <th>住所</th>
                <th>電話番号</th>
                <th>生年月日</th>
                <th>性別</th>
                <th>入社日</th>
                <th>所属(部署)</th>
                <th>備考・特記事項</th>
                <th>編集</th>
                <th>削除</th>
            </tr>
format;

    $tmp = <<<tmp
        <tr>
            <td>!社員ID!</td>
            <td>!名前姓!</td>
            <td>!名前名!</td>
            <td>!フリガナ姓!</td>
            <td>!フリガナ名!</td>
            <td>!メールアドレス!</td>
            <td>!役職!</td>
            <td>!住所!</td>
            <td>!電話番号!</td>
            <td>!生年月日!</td>
            <td>!性別!</td>
            <td>!入社日!</td>
            <td>!所属部署!</td>
            <td>!備考特記事項!</td>
            <form action="administrator.php" method="post">
                <td><input class="btn edit_btn" type="submit" value="編集"></td>
                <input type = "hidden" name = "id" value = "!id!">
                <input type = "hidden" name = "mode" value = "edit">
            </form>
            <form action="administrator.php" method="post">
                <td><input class="btn delete_btn" type="submit" value="削除"></td>
                <input type = "hidden" name = "id" value = "!id!">
                <input type = "hidden" name = "mode" value = "delete">
            </form>
        </tr>
    tmp;

        $result = tmpl($stmt, $tmp);
        
        if($result === ""){
            echo "<section><h3>検索結果</h3><p class = 'search_result_txt'>検索がヒットしませんでした</p></section>";   
        }else{
            echo "<section>" . $search_format . $result . "</table></div></section>";
        }
}

//編集機能(編集画面の生成)
function edit(){
    global $dbh;
    global $input;

    $sql = <<<sql
    select * from member where id = ?;
sql;
    $stmt = $dbh -> prepare($sql);
    $stmt -> bindParam(1,$input["id"]);
    $stmt -> execute();

    $tmp = <<<tmp
        <section>
            <h3>情報編集</h3>
            <form class="input_form" action="administrator.php" method="post">
                <p class="input_txt"><span class="input_txt_ttl">社員ID</span><input class="intext" type="text" name="member_id" required value = "!社員ID!"></p>
                <p class="input_txt"><span class="input_txt_ttl">名前（姓）</span><input class="intext" type="text" name="name_s" required value = "!名前姓!"></p>
                <p class="input_txt"><span class="input_txt_ttl">名前（名）</span><input class="intext" type="text" name="name_m" required value = "!名前名!"></p>
                <p class="input_txt"><span class="input_txt_ttl">フリガナ（姓）</span><input class="intext" type="text" name="name_s_kn" required value = "!フリガナ姓!"></p>
                <p class="input_txt"><span class="input_txt_ttl">フリガナ（名）</span><input class="intext" type="text" name="name_m_kn" required value = "!フリガナ名!"></p>
                <p class="input_txt"><span class="input_txt_ttl">メールアドレス</span><input class="intext" type="email" name="email" required value = "!メールアドレス!"></p>
                <p class="input_txt"><span class="input_txt_ttl">役職</span><input class="intext" type="text" name="position" value = "!役職!"></p>
                <p class="input_txt"><span class="input_txt_ttl">住所</span><input class="intext" type="text" name="address" required value = "!住所!"></p>
                <p class="input_txt"><span class="input_txt_ttl">電話番号</span><input class="intext" type="tel" name="tel" placeholder="0000000000" required value = "!電話番号!"></p>
                <p class="input_txt"><span class="input_txt_ttl">生年月日</span><input class="intext" type="date" name="birthday" required><p>
                <p class="input_txt"><span class="input_txt_ttl">性別</span>
                    <span class="radios">
                        <label class="radio"><input type="radio" name="gender" value="男性" required>男性</label>
                        <label class="radio"><input type="radio" name="gender" value="女性">女性</label>
                        <label class="radio"><input type="radio" name="gender" value="その他">その他</label>
                    </span>
                </p>
                <p class="input_txt"><span class="input_txt_ttl">入社日</span><input class="intext" type="date" name="joincom" required></p>
                <p class="input_txt"><span class="input_txt_ttl">所属（部署）</span><input class="intext" type="text" name="department" required value = "!所属部署!"></p>
                <p class="comment_ttl">備考・特記事項</p>
                <textarea name="comment">!備考特記事項!</textarea>

                <div class="check_btns">
                    <p><a class="btn return_btn" onclick="history.back()">戻る</a></p>
                    <p><input class="btn submit_btn" type="submit"></p>
                    <input type = "hidden" name = "id" value = "!id!">
                    <input type = "hidden" name = "mode" value = "update">
                </div>
            </form>
        </section>
tmp;

    echo  tmpl($stmt, $tmp);
}

//更新機能(上記編集画面の情報を、DBに登録)
function update(){
    global $dbh;
    global $input;        

    $sql = <<<sql
    update member set 
        member_id = ?,
        name_s = ?,
        name_m = ?,
        name_s_kn = ?,
        name_m_kn = ?,
        email = ?,
        position = ?,
        address = ?,
        tel = ?,
        birthday = ?,
        gender = ?,
        joincom = ?,
        department = ?,
        comment = ?
        where id = ?;
sql;

$stmt = $dbh -> prepare($sql);
$stmt -> bindParam(1,$input["member_id"]);
$stmt -> bindParam(2,$input["name_s"]);
$stmt -> bindParam(3,$input["name_m"]);
$stmt -> bindParam(4,$input["name_s_kn"]);
$stmt -> bindParam(5,$input["name_m_kn"]);
$stmt -> bindParam(6,$input["email"]);
$stmt -> bindParam(7,$input["position"]);
$stmt -> bindParam(8,$input["address"]);
$stmt -> bindParam(9,$input["tel"]);
$stmt -> bindParam(10,$input["birthday"]);
$stmt -> bindParam(11,$input["gender"]);
$stmt -> bindParam(12,$input["joincom"]);
$stmt -> bindParam(13,$input["department"]);
$stmt -> bindParam(14,$input["comment"]);
$stmt -> bindParam(15,$input["id"]);
$stmt -> execute();

}

//削除機能
function delete(){
    global $dbh;
    global $input;

    $sql = <<<sql
    update member set flag = 0 where id = ?;
sql;
    $stmt = $dbh -> prepare($sql);
    $stmt -> bindParam(1,$input["id"]);
    $stmt -> execute();
}

// テンプレート置き換え関数
function tmpl($stmt, $tmp){

    $block = "";

    while($row = $stmt -> fetch()){
        //テンプレの初期化
        $insert = $tmp;

        $insert = str_replace("!社員ID!",$row["member_id"] ,$insert);
        $insert = str_replace("!名前姓!",$row["name_s"] ,$insert);
        $insert = str_replace("!名前名!",$row["name_m"] ,$insert);
        $insert = str_replace("!フリガナ姓!",$row["name_s_kn"] ,$insert);
        $insert = str_replace("!フリガナ名!",$row["name_m_kn"] ,$insert);
        $insert = str_replace("!メールアドレス!",$row["email"] ,$insert);
        $insert = str_replace("!役職!",$row["position"] ,$insert);
        $insert = str_replace("!住所!",$row["address"] ,$insert);
        $insert = str_replace("!電話番号!",$row["tel"] ,$insert);
        $insert = str_replace("!生年月日!",$row["birthday"] ,$insert);
        $insert = str_replace("!性別!",$row["gender"] ,$insert);
        $insert = str_replace("!入社日!",$row["joincom"] ,$insert);
        $insert = str_replace("!所属部署!",$row["department"] ,$insert);
        $insert = str_replace("!備考特記事項!",$row["comment"] ,$insert);
        $insert = str_replace("!id!",$row["id"] ,$insert);
        
        $block .= $insert;
    }
    return $block;
}

?>

<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>-管理者&nbsp;Sin shine&nbsp;社員情報管理アプリ</title>
<link rel="stylesheet" href="style.css"></link>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@300;400;700&display=swap" rel="stylesheet">
<meta name=”viewport” content=”width=device-width,initial-scale=1.0″>
</head>

<body>
<header><div class="logo">Sin shine</div></header>

<main>

    <h2>管理者画面</h2>

    <section>
        <form action="administrator.php" method="post">
            <p class="search_banner"><input type="text" class="search_banner_txt" name="search" placeholder = "キーワードを入力して検索" required><input type="submit" class="search_btn" value="&#10004;"><input type="hidden" name="mode" value="search"></p>
        </form>
    </section>

    <?php
        if(isset($input["mode"]) && $input["mode"] === "edit"){
            edit();
        }
        elseif(isset($input["mode"]) && $input["mode"] === "search"){
            search();
        }
    ?>
 
    <section>

        <h3>社員一覧</h3>

        <div class="table_box">
            <table>
                <tr>
                    <th>社員ID</th>
                    <th>名前(姓)</th>
                    <th>名前(名)</th>
                    <th>フリガナ(姓)</th>
                    <th>フリガナ(名)</th>
                    <th>メールアドレス</th>
                    <th>役職</th>
                    <th>住所</th>
                    <th>電話番号</th>
                    <th>生年月日</th>
                    <th>性別</th>
                    <th>入社日</th>
                    <th>所属(部署)</th>
                    <th>備考・特記事項</th>
                    <th>編集</th>
                    <th>削除</th>
                </tr>
    
                    <?php display(); ?>
            </table>
        </div>

    </section>
</main>

<footer><small>&copy;2024&nbsp;Mori&nbsp;Haruki&nbsp;All&nbsp;right&nbsp;reserved</small></footer>
</body>
</html>