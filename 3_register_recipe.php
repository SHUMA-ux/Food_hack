<?php 
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
                        <td><input type="text" name="morning_recipe" value="<?php echo $row['name'];?>" readonly style="cursor: pointer;"></td>
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
                        <td><input type="text" name="day_recipe" value="<?php echo $row['name'];?>" readonly style="cursor: pointer;"></td>
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
                        <td><input type="text" name="night_recipe" value="<?php echo $row['name'];?>" readonly style="cursor: pointer;"></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </form>
    </body>
</html>