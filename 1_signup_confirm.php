<?php 
require_once("db_connect.php");
require_once("function.php");
?>

<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div>
        <h1>ユーザー情報の入力</h1>
        <br>
        <p>
            <form method="POST" action="">
            <dt>ニックネーム</dt>
                <dd>
                    <?php $_SESSION["name"] = $row['name'];?>
                </dd>
            <dt>性別</dt>
                <dd>
                    <?php $_SESSION["gender"] = $row['gender'];?>  
                </dd>
            <dt>都道府県</dt>
                <dd>
                    <?php $_SESSION["place"] = $row['id'];?>
                </dd>
            <dt>年齢</dt>
                <dd>
                    <?php $_SESSION["age"] = $row['age'];?>
                    
                </dd>
            <dt>メールアドレス（ログインID）</dt>
                <dd>
                    <?php $_SESSION["user_name"] = $row['user_name'];?>
                </dd>
            <dt>パスワード</dt>
                <dd>
                    セキュリティのため非表示にしています
                </dd>

                <p><input type="submit" value="新規登録" id="signUp" name="signUp"></p>
            </form>
        </p>
    </div>
</body>
</html>