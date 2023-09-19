<?php 
session_start();
require_once("db_connect.php");
require_once("function.php");
CheckUserData_2()
?>

<!doctype html>
<html lang="ja">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>ログインページ</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <a href="1_signup.php" style="text-decoration:none;">新規ユーザー登録</a>
            <form method="post" action="">
                <input type="text" name="user_name" placeholder="メールアドレス（ログインID）">
                    <input type="text" name="password"  placeholder="パスワード">
                        <input type="submit" value="ログイン">
                    </form>
                </p>
        </div>
    </body>
</html>