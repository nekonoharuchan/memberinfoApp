<?php
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

?>

<!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>-確認&nbsp;Sin shine&nbsp;社員情報管理アプリ</title>
<link rel="stylesheet" href="style.css"></link>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@300;400;700&display=swap" rel="stylesheet">
<meta name=”viewport” content=”width=device-width,initial-scale=1.0″>
</head>

<body>
<header><div class="logo">Sin shine</div></header>

<main>
    <h2>登録の確認</h2>

    <section>
        <dl class="check_list">
            <div class="check_txt">
                <dt>社員ID</dt>
                <dd><?php echo $input["id"];?></dd>
            </div>

            <div class="check_txt">
                <dt>名前（姓）</dt>
                <dd><?php echo $input["name_s"];?></dd>
            </div>

            <div class="check_txt">
                <dt>名前（名）</dt>
                <dd><?php echo $input["name_m"];?></dd>
            </div>

            <div class="check_txt">
                <dt>フリガナ（姓）</dt>
                <dd><?php echo $input["name_s_kn"];?></dd>
            </div>

            <div class="check_txt">
                <dt>フリガナ（名）</dt>
                <dd><?php echo $input["name_m_kn"];?></dd>
            </div>

            <div class="check_txt">
                <dt>メールアドレス</dt>
                <dd><?php echo $input["email"];?></dd>
            </div>

            <div class="check_txt">
                <dt>役職</dt>
                <dd><?php echo $input["position"];?></dd>
            </div>

            <div class="check_txt">
                <dt>住所</dt>
                <dd><?php echo $input["address"];?></dd>
            </div>

            <div class="check_txt">
                <dt>電話番号</dt>
                <dd><?php echo $input["tel"];?></dd>
            </div>

            <div class="check_txt">
                <dt>生年月日</dt>
                <dd><?php echo $input["birthday"];?></dd>
            </div>

            <div class="check_txt">
                <dt>性別</dt>
                <dd><?php echo $input["gender"];?></dd>
            </div>

            <div class="check_txt">
                <dt>入社日</dt>
                <dd><?php echo $input["join"];?></dd>
            </div>

            <div class="check_txt">
                <dt>所属（部署）</dt>
                <dd><?php echo $input["department"];?></dd>
            </div>

            <div class="check_txt">
                <dt>備考・特記事項</dt>
                <dd><?php echo $input["comment"];?></dd>
            </div>

        </dl>
    </section>
    
    <form action="insert.php" method="post">
        <div class="check_btns">
            <p><a class="btn return_btn" href="contact.html">戻る</a></p>
            <p><input class="btn" type="submit" value="進む"></p>

            <input type="hidden" name="member_info" value="<?php echo $input; ?>">
            <input type="hidden" name="id" value="<?php echo $input["id"]; ?>">
            <input type="hidden" name="name_s" value="<?php echo $input["name_s"]; ?>">
            <input type="hidden" name="name_m" value="<?php echo $input["name_m"]; ?>">
            <input type="hidden" name="name_s_kn" value="<?php echo $input["name_s_kn"]; ?>">
            <input type="hidden" name="name_m_kn" value="<?php echo $input["name_m_kn"]; ?>">
            <input type="hidden" name="email" value="<?php echo $input["email"]; ?>">
            <input type="hidden" name="position" value="<?php echo $input["position"]; ?>">
            <input type="hidden" name="address" value="<?php echo $input["address"]; ?>">
            <input type="hidden" name="tel" value="<?php echo $input["tel"]; ?>">
            <input type="hidden" name="birthday" value="<?php echo $input["birthday"]; ?>">
            <input type="hidden" name="gender" value="<?php echo $input["gender"]; ?>">
            <input type="hidden" name="join" value="<?php echo $input["join"]; ?>">
            <input type="hidden" name="department" value="<?php echo $input["department"]; ?>">
            <input type="hidden" name="comment" value="<?php echo $input["comment"]; ?>">
        </div>
    </form>
</main>

<footer><small>&copy;2024&nbsp;Mori&nbsp;Haruki&nbsp;All&nbsp;right&nbsp;reserved</small></footer>
</body>
</html>