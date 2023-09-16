<?php
$db['host'] = "localhost";
$db['user'] = "root";
$db['pass'] = "root";
$db['dbname'] = "Food_hack";

function connect(){
    $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8',"localhost", "Food_hack");
    $pdo = new PDO($dsn, "root", "root", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $pdo;
}
?>