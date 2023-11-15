<?php
$qFilename = "data/question.csv";
$fp = fopen($qFilename, "r");
$date = date("Y-m-d H:i:s");
$name = $_POST["name"];
$comment = $_POST["comment"];
$c    = ",";
$str = $date.$c.$name.$c;
for( $i = 1; fgets($fp); $i++ ){
  $str .= $_POST["Q".$i].$c;
};

$str .= $_POST["comment"];


fclose($fp);

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
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <p class="msg">ご回答ありがとうございました！</p>
  <button onclick="location.href='./read.php'">結果を見る</button>
</body>
</html>