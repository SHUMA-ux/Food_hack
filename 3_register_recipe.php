<?php 
session_start();
require_once("db_connect.php");
require_once("function.php");
check_user_logged_in();
?>
<?php 
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
}

    ?>

<!doctype html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>メイン</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
    <form method="POST" action="">
            <div class="flex">
                <table>
                    <tr>
                        <th>朝食</th>
                    </tr>
                <?php 
                    $pdo=connect();
                    $sql = "SELECT * FROM general_recipe ORDER BY morning DESC,  rank DESC, recipe_id ASC;;";
                    $stmt = $pdo->prepare($sql);
                    $stmt -> execute();
                    while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                    <td><input type="checkbox" name="morning_recipes[]" id="<?php echo $row['name'];?>" value="<?php echo $row['name'];?>"><?php echo $row['name'];?></td>
                    </tr>
                    <?php } ?>
                </table>

                <table>
                    <tr>
                        <th>昼食</th>
                    </tr>
                <?php 
                    $pdo=connect();
                    $sql = "SELECT * FROM general_recipe ORDER BY day DESC,  rank DESC, recipe_id ASC;;";
                    $stmt = $pdo->prepare($sql);
                    $stmt -> execute();
                    while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><input type="checkbox" name="day_recipes[]" id="<?php echo $row['name'];?>" value="<?php echo $row['name'];?>"><?php echo $row['name'];?></td>
                    </tr>
                    <?php } ?>
                </table>
                
                <table>
                    <tr>
                        <th>夕食</th>
                    </tr>
                <?php 
                    $pdo=connect();
                    $sql = "SELECT * FROM general_recipe ORDER BY night DESC,  rank DESC, recipe_id ASC;;";
                    $stmt = $pdo->prepare($sql);
                    $stmt -> execute();
                    while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                        <td><input type="checkbox" name="night_recipes[]" id="<?php echo $row['name'];?>" value="<?php echo $row['name'];?>"><?php echo $row['name'];?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            <div>
                <input type="submit" value="登録"  id="post" name="post">
            </div>
        </form>
    </body>
</html>