<?php
$date = date("Y-m-d H:i:s");
$name = $_POST["name"];
$q1 = $_POST["q1"];
$q2 = $_POST["q2"];
$q3 = $_POST["q3"];
$q4 = $_POST["q4"];
$comment = $_POST["comment"];

$c    = ",";


//文字作成
$str = $date.$c.$name.$c.$q1.$c.$q2.$c.$q3.$c.$q4.$c.$comment;

//File書き込み
$file = fopen("data/result.csv","a");	// ファイル読み込み
fwrite($file, $str."\n");//<br> バックスラッシュはoption+¥　タブは\t
fclose($file);
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>送信完了</title>
</head>
<body>
  <p>ご回答ありがとうございました！</p>
  <button onclick="location.href='./read.php'">結果を見る</button>
</body>
</html>