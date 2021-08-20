<?php
//人事データ更新する画面
 echo "<form action='csv_upload_result.php' method='POST' enctype='multipart/form-data'>";
 echo "アップロード：<input name='upfile' type='file'/>";
 echo "<input type='submit' value='ファイル送信'/>";
 echo "</form>";
?>