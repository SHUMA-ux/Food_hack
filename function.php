<?php 
require_once("db_connect.php");

function check_user_logged_in(){
    if (empty($_SESSION["user_id"])) {
        header("Location: 2_login.php");
        exit;
    }
}


function CreateUserData(){
    if (!empty($_POST)) {
        if (empty($_POST["name"])) {
            echo "ユーザー名が未入力です。";
        }
        if (empty($_POST["gender"])) {
            echo "性別が未入力です。";
        }
        if (empty($_POST["place"])) {
            echo "都道府県が未入力です。";
        }
        if (empty($_POST["age"])) {
            echo "年齢が未入力です。";
        }
        if (empty($_POST["user_name"])) {
            echo "メールアドレスが未入力です。";
        }
        if (empty($_POST["password"])) {
            echo "パスワードが未入力です。";
        }
        if (!empty($_POST["name"]) && !empty($_POST["gender"]) && !empty($_POST["place"]) && !empty($_POST["age"]) && !empty($_POST["user_name"]) && !empty($_POST["password"])) {
            $name = htmlspecialchars($_POST['name'], ENT_QUOTES);
            $gender = htmlspecialchars($_POST['gender'], ENT_QUOTES);
            $place = htmlspecialchars($_POST['place'], ENT_QUOTES);
            $age = htmlspecialchars($_POST['age'], ENT_QUOTES);
            $user_name = htmlspecialchars($_POST['user_name'], ENT_QUOTES);
            $password = htmlspecialchars($_POST['password'], ENT_QUOTES);

            $pdo = connect();
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (name, gender, place, age, user_name, password) VALUES (:name, :gender, :place, :age, :user_name, :password);";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':name', $name);
            $stmt->bindValue(':gender', $gender);
            $stmt->bindValue(':place', $place);
            $stmt->bindValue(':age', $age);
            $stmt->bindValue(':user_name', $user_name);
            $stmt->bindValue(':password', $password_hash);
            $stmt->execute();
            header("Location: 2_login.php");
            exit();
        } 
    }
}


function CheckUserData(){
    if (!empty($_POST)) {
        if (empty($_POST["user_name"])) {
            echo "メールアドレスが未入力です。";
        }
        if (empty($_POST["password"])) {
            echo "パスワードが未入力です。";
        }
        if (!empty($_POST["user_name"]) && !empty($_POST["password"])) {
            $user_name = htmlspecialchars($_POST['user_name'], ENT_QUOTES);
            $password = htmlspecialchars($_POST['password'], ENT_QUOTES);
            $pdo = connect();
            try {
                $sql = "SELECT * FROM users WHERE user_name = :user_name";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':user_name', $user_name);
                $stmt->execute();
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
                die();
            }

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if (password_verify($password, $row["password"])) {
                    $_SESSION["user_id"] = $row['user_id'];
                    $_SESSION["name"] = $row['name'];
                    $_SESSION["gender"] = $row['gender'];
                    $_SESSION["place"] = $row['id'];
                    $_SESSION["age"] = $row['age'];
                    $_SESSION["user_name"] = $row['user_name'];
                    header("Location: 3_register_recipe.php");
                    exit;
                } else {
                    echo "パスワードに誤りがあります。";
                }
            } else {
                echo "ユーザー名かパスワードに誤りがあります。";
            }
        }
    }
}