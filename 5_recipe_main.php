<?php 
session_start();
require_once("db_connect.php");
require_once("function.php");
check_user_logged_in();
?>




<!doctype html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>メイン</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
    <div class="flex">
        <div>
        <dt>朝食</dt>
            <?php 
            $pdo=connect();
            $morning_sql = "SELECT * FROM recipe WHERE user_id=:id AND morning=1;";
            $morning_stmt = $pdo->prepare($morning_sql);
            $morning_stmt ->bindParam(':id',$_SESSION["user_id"]);
            $morning_stmt -> execute();
            while ($morning_row=$morning_stmt->fetch(PDO::FETCH_ASSOC)) { 
                ?>
            <dd><?php echo $morning_row['name'] ?></dd>
            <?php }?>
        </div>
        <div>
            <dt>昼食</dt>
            <?php 
            $pdo=connect();
            $day_sql = "SELECT * FROM recipe WHERE user_id=:id AND day=1;";
            $day_stmt = $pdo->prepare($day_sql);
            $day_stmt ->bindParam(':id',$_SESSION["user_id"]);
            $day_stmt -> execute();
            while ($day_row=$day_stmt->fetch(PDO::FETCH_ASSOC)) { 
                ?>
            <dd><?php echo $day_row['name'] ?></dd>
            <?php }?>
            </div>
        <div>
            <dt>夕食</dt>
            <?php 
            $pdo=connect();
            $night_sql = "SELECT * FROM recipe WHERE user_id=:id AND night=1;";
            $night_stmt = $pdo->prepare($night_sql);
            $night_stmt ->bindParam(':id',$_SESSION["user_id"]);
            $night_stmt -> execute();
            while ($night_row=$night_stmt->fetch(PDO::FETCH_ASSOC)) { 
                ?>
            <dd><?php echo $night_row['name'] ?></dd>
            <?php }?>
            </div>
        </div>
    </body>
       
         
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


?>



    </body>
</html>