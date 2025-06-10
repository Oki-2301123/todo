<?php
function DB(){
 $param = 'mysql:host=mysql322.phy.lolipop.lan;
              dbname=LAA1554893-tododb;charset=utf8';
    $user = 'LAA1554893';
    $pass = 'tododev';
    try {
        $pdo = new PDO($param, $user, $pass);
        return $pdo;
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}