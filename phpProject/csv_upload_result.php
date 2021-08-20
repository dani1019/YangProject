<?php
//人事データをinsertする処理
$upload_dir = "C:\\xampp\htdocs\php\chapter2\\";
date_default_timezone_set('Asia/Tokyo');

$tempfile= $_FILES['upfile']['tmp_name'];
$filename =  $upload_dir . basename($_FILES['upfile']['name'],'.csv') . date('mdHis') .'.csv';

if(is_uploaded_file($tempfile)){
  if(move_uploaded_file($tempfile , $filename)){
     echo $filename . "をアップロードしました。";
  }else{
     echo "ファイルアップロードができませんでした。";
  }
}else{
  echo "ファイルが選択されませんでした。";
}


 $dsn='mysql:dbname=mysql;host=localhost;charset:utf-8';
 $user = 'yang';
 $password = 'yang';

 try{
 $handle = fopen($filename,'r');

 $pdo = new PDO($dsn,$user,$password);
 $pdo->beginTransaction();
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 $count = 0;
 while(($line = fgetcsv($handle)) !== FALSE){

 $sql="insert into csv_upload(dep,sha_no,name) values(:dep,:sha_no ,:name)";
 $stmt= $pdo->prepare($sql);
 
 ++$count;
 if($count == 1){
     continue;
  }
 $params = [':dep'=> $line[0],
            ':sha_no' => $line[1],
            ':name' => $line[2]
           ];

$result=$stmt->execute($params);
}
 fclose($handle);
 $pdo->commit();
   
}catch(PDOException $e){
  $pdo->rollBack();
  echo $e->getMessage();
}
?>