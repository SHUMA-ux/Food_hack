<?php 
session_start();
require_once("db_connect.php");
require_once("function.php");
check_user_logged_in();

if(!empty($_POST)){
    if (isset($_POST["morning_recipes"])) {
        $morning_recipes = $_POST["morning_recipes"];
    } else {
        $morning_recipes = [];
    }

    if (isset($_POST["day_recipes"])) {
        $day_recipes = $_POST["day_recipes"];
    } else {
        $day_recipes = [];
    }

    if (isset($_POST["night_recipes"])) {
        $night_recipes = $_POST["night_recipes"];
    } else {
        $night_recipes = [];
    }

    if (count($morning_recipes) < 3) {
        echo "朝食のレシピが" . count($morning_recipes) . "しか登録されていません。3つ以上、選択してください";
    } elseif (count($day_recipes) < 3) {
        echo "昼食のレシピが" . count($day_recipes) . "しか登録されていません。3つ以上、選択してください";
    } elseif (count($night_recipes) < 3) {
        echo "夕食のレシピが" . count($night_recipes) . "しか登録されていません。3つ以上、選択してください";
    } else {
        $morning_recipes_str = implode(",", $morning_recipes);
        $day_recipes_str = implode(",", $day_recipes);
        $night_recipes_str = implode(",", $night_recipes);
        header("Location: 3-1_register_recipe_confirm.php?morning=" . urlencode($morning_recipes_str) . "&day=" . urlencode($day_recipes_str). "&night=" . urlencode($night_recipes_str));
    }





if (isset($_GET["morning"]) && isset($_GET["day"]) && isset($_GET["night"])) {
    $morning_recipes_str = urldecode($_GET["morning"]);
    $day_recipes_str = urldecode($_GET["day"]);
    $night_recipes_str = urldecode($_GET["night"]);

    $morning_recipes = explode(",", $morning_recipes_str);
    $day_recipes = explode(",", $day_recipes_str);
    $night_recipes = explode(",", $night_recipes_str);
?>




<!doctype html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>メイン</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <div>
            <p>選んだレシピはこちらで間違いないですか？</p>
        </div>
        <div class="flex">
                <div>
                    <dt>朝食</dt>
                    <?php foreach ($morning_recipes as $morning_recipe) {
                        echo "<dd>".htmlspecialchars($morning_recipe)."</dd>";
                    }?>
                </div>

                <div>
                    <dt>昼食</dt>
                    <?php foreach ($day_recipes as $day_recipe) {
                        echo "<dd>".htmlspecialchars($day_recipe)."</dd>";
                        }?>
                </div>

                <div>
                    <dt>夕食</dt>
                    <?php foreach ($night_recipes as $night_recipe) {
                        echo "<dd>".htmlspecialchars($night_recipe)."</dd>";
                        }?>
                </div>
            </div>
            <form method="POST" action="">
                    <input type=submit name="data_submit" value="完了">
            </form>
        </div>
        

        <?php
        if (!empty($_POST["data_submit"])) {
            $pdo = connect();
            // 朝食
            $morning_sql = "SELECT * FROM general_recipe WHERE name IN ('" . implode("', '", $morning_recipes) . "')";
            $morning_stmt = $pdo->prepare($morning_sql);
            $morning_stmt->execute();
            while ($row = $morning_stmt->fetch(PDO::FETCH_ASSOC)) {
                $user_id = $_SESSION["user_id"];
                $current_time = date("Y-m-d H:i:s");
                $insert_sql = "INSERT INTO recipe (user_id, created_date, name, morning, day, night, rice, noodle, beef, onion, carrot, egg, ketchup, rank) VALUES (:user_id, :created_date, :name, 1, 0, 0, :rice, :noodle, :beef, :onion, :carrot, :egg, :ketchup, :rank)";
                $insert_stmt = $pdo->prepare($insert_sql);
                $insert_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $insert_stmt->bindParam(':created_date', $current_time, PDO::PARAM_STR);
                $insert_stmt->bindParam(':name', $row["name"], PDO::PARAM_STR);
                $insert_stmt->bindParam(':rice', $row["rice"], PDO::PARAM_STR);
                $insert_stmt->bindParam(':noodle', $row["noodle"], PDO::PARAM_STR);
                $insert_stmt->bindParam(':beef', $row["beef"], PDO::PARAM_STR);
                $insert_stmt->bindParam(':onion', $row["onion"], PDO::PARAM_STR); // カンマを削除
                $insert_stmt->bindParam(':carrot', $row["carrot"], PDO::PARAM_STR);
                $insert_stmt->bindParam(':egg', $row["egg"], PDO::PARAM_STR);
                $insert_stmt->bindParam(':ketchup', $row["ketchup"], PDO::PARAM_STR);
                $insert_stmt->bindParam(':rank', $row["rank"], PDO::PARAM_STR);
                $insert_stmt->execute();
        }
            
            // 昼食
            $day_sql = "SELECT * FROM general_recipe WHERE name IN ('" . implode("', '", $day_recipes) . "')";
            $day_stmt = $pdo->prepare($day_sql);
            $day_stmt->execute();
            while ($row = $day_stmt->fetch(PDO::FETCH_ASSOC)) {
                $user_id = $_SESSION["user_id"];
                $current_time = date("Y-m-d H:i:s");
                $insert_sql = "INSERT INTO recipe (user_id, created_date, name, morning, day, night, rice, noodle, beef, onion, carrot, egg, ketchup, rank) VALUES (:user_id, :created_date, :name, 0, 1, 0, :rice, :noodle, :beef, :onion, :carrot, :egg, :ketchup, :rank)";
                $insert_stmt = $pdo->prepare($insert_sql);
                $insert_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $insert_stmt->bindParam(':created_date', $current_time, PDO::PARAM_STR);
                $insert_stmt->bindParam(':name', $row["name"], PDO::PARAM_STR);
                $insert_stmt->bindParam(':rice', $row["rice"], PDO::PARAM_STR);
                $insert_stmt->bindParam(':noodle', $row["noodle"], PDO::PARAM_STR);
                $insert_stmt->bindParam(':beef', $row["beef"], PDO::PARAM_STR);
                $insert_stmt->bindParam(':onion', $row["onion"], PDO::PARAM_STR); // カンマを削除
                $insert_stmt->bindParam(':carrot', $row["carrot"], PDO::PARAM_STR);
                $insert_stmt->bindParam(':egg', $row["egg"], PDO::PARAM_STR);
                $insert_stmt->bindParam(':ketchup', $row["ketchup"], PDO::PARAM_STR);
                $insert_stmt->bindParam(':rank', $row["rank"], PDO::PARAM_STR);
                $insert_stmt->execute();
        }
        // 夕食
        $night_sql = "SELECT * FROM general_recipe WHERE name IN ('" . implode("', '", $night_recipes) . "')";
            $night_stmt = $pdo->prepare($night_sql);
            $night_stmt->execute();
            while ($row = $night_stmt->fetch(PDO::FETCH_ASSOC)) {
                $user_id = $_SESSION["user_id"];
                $current_time = date("Y-m-d H:i:s");
                $insert_sql = "INSERT INTO recipe (user_id, created_date, name, morning, day, night, rice, noodle, beef, onion, carrot, egg, ketchup, rank) VALUES (:user_id, :created_date, :name, 0, 0, 1, :rice, :noodle, :beef, :onion, :carrot, :egg, :ketchup, :rank)";
                $insert_stmt = $pdo->prepare($insert_sql);
                $insert_stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $insert_stmt->bindParam(':created_date', $current_time, PDO::PARAM_STR);
                $insert_stmt->bindParam(':name', $row["name"], PDO::PARAM_STR);
                $insert_stmt->bindParam(':rice', $row["rice"], PDO::PARAM_STR);
                $insert_stmt->bindParam(':noodle', $row["noodle"], PDO::PARAM_STR);
                $insert_stmt->bindParam(':beef', $row["beef"], PDO::PARAM_STR);
                $insert_stmt->bindParam(':onion', $row["onion"], PDO::PARAM_STR); // カンマを削除
                $insert_stmt->bindParam(':carrot', $row["carrot"], PDO::PARAM_STR);
                $insert_stmt->bindParam(':egg', $row["egg"], PDO::PARAM_STR);
                $insert_stmt->bindParam(':ketchup', $row["ketchup"], PDO::PARAM_STR);
                $insert_stmt->bindParam(':rank', $row["rank"], PDO::PARAM_STR);
                $insert_stmt->execute();
        }

                header("Location: 4_register_food.php");
            exit();
            
        }
}

?>



    </body>
</html>