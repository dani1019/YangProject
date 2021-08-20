<?php
//人事データ削除処理
 $dsn='mysql:dbname=mysql;host=localhost;charset:utf-8';
 $user = 'yang';
 $password = 'yang';

 $sql="delete from csv_upload";

 try{
    $pdo = new PDO($dsn,$user,$password);
    $pdo-> beginTransaction();
    $pdo-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $res = $pdo->exec($sql);
   
    echo "データが削除されました。";

    $pdo->commit();

 }catch(PDOException $e){
    $pdo->rollBack();
    echo $e->getMessage();  
    echo "初期化処理が失敗しました。";
 }
?>