<?php 
$qFilename = "data/question.csv";
$fp = fopen($qFilename, "r");

$phpQuestion = [];
while(!feof($fp)){
  $ary = explode(",", fgets($fp));
  if(count($ary)!=1){ 
    $select = [];
    for($i=1; $i<count($ary); $i++){
      array_push($select, $ary[$i]);
    }
   
    $keyVal = array('question'=>$ary[0]);
    $keyVal += array('answer'=>$select);
    array_push($phpQuestion, $keyVal);
  }
}
fclose($fp);

$colon=" : ";
$q="Q";
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>アンケート</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>LAB16 アンケート</h1>
    <button onclick="location.href='./read.php'">結果を表示</button>
  </header>
  <main>
    <form action="write.php" method="post">
      <div>
        <p class="question required">回答者の名前</p>
        <input class="name" type="text" name="name" required>
      </div>
      <?php for($i=0; $i<count($phpQuestion); $i++){ ?>
        <div class="question_area panel">
          <p class="question required"><?=$q.($i+1).$colon.$phpQuestion[$i]["question"]?></p>
          <label><input type="radio" name=<?=$q.($i+1)?> value="1" checked><?=$phpQuestion[$i]["answer"][0]?></label>
          <label><input type="radio" name=<?=$q.($i+1)?> value="2"><?=$phpQuestion[$i]["answer"][1]?></label>
          <label><input type="radio" name=<?=$q.($i+1)?> value="3"><?=$phpQuestion[$i]["answer"][2]?></label>
          <label><input type="radio" name=<?=$q.($i+1)?> value="4"><?=$phpQuestion[$i]["answer"][3]?></label>
          <label><input type="radio" name=<?=$q.($i+1)?> value="5"><?=$phpQuestion[$i]["answer"][4]?></label>
        </div>
      <?php } ?>

      <input class="qCnt" type="text" name="qCnt" val=<?=count($phpQuestion)?>>
      <div class="question_area">
        <p class="question">その他メッセージ等あればご記入ください。</p>
        <textarea type="text" name="comment"></textarea>  
      </div>
      
	    <input type="submit" value="送信">
     </form>
  </main>


</body>
</html>