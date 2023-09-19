<?php 
session_start();
require_once("db_connect.php");
require_once("function.php");
check_user_logged_in()
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
            <h3>米・パン・麺など</h3>
            <div class="container">
                <?php 
                $pdo=connect();
                $sql = "SELECT * FROM general_food WHERE nutrition='炭水化物' ORDER BY rank DESC, food_id ASC;";
                $stmt = $pdo->prepare($sql);
                $stmt -> execute();
                while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="item">
                <option value="ammount" selected><?php echo $row['name'] ?></option>
                    <select name=<?php echo $row['name'] ?> value=<?php echo $row['name'] ?> >
                    <option value="ammount" >選択してください</option>
                    <?php for ($i = 100; $i <= 10000; $i += 100) {
                        echo "<option value=\"$i\">$i</option>";
                    }
                    ?>
                    </select>

                </div>
                <?php } ?>
                </div>
            </div>
</select>

            <h3>肉・魚・卵など</h3>
            <div class="container">
                <?php 
                $pdo=connect();
                $sql = "SELECT * FROM general_food WHERE nutrition='タンパク質' ORDER BY rank DESC, food_id ASC;";
                $stmt = $pdo->prepare($sql);
                $stmt -> execute();
                while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                <div class="item">
                    <input type="checkbox" name="protein" id="<?php echo $row['name'];?>" value="<?php echo $row['name'];?>">
                    <?php echo $row['name'];?>
                    <input type="number" name='protein_quantity'id=<?php $row['name'] ?> disabled>
                </div>
                <?php } ?>
                </div>
            </div>

            <h3>野菜</h3>
            <div class="container">
            <div class="container">
                <?php 
                    $pdo=connect();
                    $sql = "SELECT * FROM general_food WHERE nutrition='野菜' ORDER BY rank DESC, food_id ASC;";
                    $stmt = $pdo->prepare($sql);
                    $stmt -> execute();
                    while ($row=$stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                    <div class="item">
                        <input type="checkbox" name="vegetables" id="<?php echo $row['name'];?>" value="<?php echo $row['name'];?>">
                        <?php echo $row['name'];?>
                        <input type="number" name='vegetables_quantity'id=<?php $row['name'] ?> disabled>
                    </div>
                <?php } ?>
                </div>
            </div>
            <div>
                <input type="submit" value="登録"  id="post" name="post">
            </div>
        </form>
    </body>
</html>
