<?php 
$filename = "data/result.csv";
$fp = fopen($filename, "r");

$phpResult = [];
while(!feof($fp)){
  $ary = explode(",", fgets($fp));
  $keyVal = array('date'=>$ary[0]);
  $keyVal += array('name'=>$ary[1]);
  for($i=0; $i<=count($ary)-1; $i++){
    if($i<=1){
      continue;
    }elseif($i==count($ary)-1){
      $keyVal += array('comment'=>str_replace(array("\r", "\n"), '', $ary[$i]));
    }else{
      $keyVal += array('Q'.($i-1)=>$ary[$i]);
    }
  }
  
  array_push($phpResult, $keyVal);
}

fclose($fp);
$resultJson = json_encode($phpResult);

$qFilename = "data/question.csv";
$qfp = fopen($qFilename, "r");

$phpQuestion = [];
while(!feof($qfp)){
  $ary = explode(",", fgets($qfp));
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
fclose($qfp);

$questionJson = json_encode($phpQuestion);
$colon=" : ";
$q="Q";
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>アンケート結果</title>
  <link rel="stylesheet" href="css/style.css">
<body>
  <header>
    <h1>アンケート結果</h1>
    <button onclick="location.href='./post.php'">回答画面に戻る</button>
  </header>
  <main>
    <h2>集計結果 <span class="answer_num">（回答人数：<?= count($phpResult)-1?>人）</span></h2>
    <div class="q_result">
    <?php for($i=0; $i<=count($phpQuestion)-1; $i++){ ?>
      <?php if(($i+1)%2==1){?>
        <div class="result_row">
      <?php }?>

        <div class="answer_area">
          <p class="question"><?=$q.($i+1).$colon.$phpQuestion[$i]["question"]?></p>
          <canvas id=<?=$q.($i+1)?>>
        </div>
      
      <?php if(($i+1)%2==0||$i==count($phpQuestion)-1){?>
        </div>
      <?php }?>

    <?php }?>
    
    <div>
      <h2>コメント</h2>
      <ul id="comment">
        <?php for($i=0; $i<count($phpResult)-1; $i++){ ?>
          <?php if(!empty($phpResult[$i]["comment"])){?>
            <li class="comment">
              <p><?= $phpResult[$i]["date"]." ".$phpResult[$i]["name"] ?></p>
              <p><?= $phpResult[$i]["comment"]?></p>
            </li>
          <?php  }?>
        <?php  }?>
      </ul>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
  <script>
    const firstColor = ["#254278","#006bbe","#7ec8ef","#ede8e4","#c1afa8"];
    const secondColor = ["#810023","#BB1945","#F97EA0","#ede8e4","#c1afa8"];
    const q = "Q";
    //質問の処理
    const questionJson = '<?php echo $questionJson; ?>';
    const editQJson = questionJson.replace(/[\u0000-\u0019]+/g, "");
    const qArray = JSON.parse(editQJson);
    const qCnt = qArray.length;

    //回答結果の処理
    const resultJson = '<?php echo $resultJson; ?>';
    const editRsJson = resultJson.replace(/[\u0000-\u0019]+/g, "");
    const rsArray = JSON.parse(editRsJson);
    const memberNum = rsArray.length;

    let colorFlg=0;
    let c = 0;
    for(let i=0; i<qCnt; i++){
      
      if(c==2 && colorFlg==0){
        colorFlg = 1;
        c = 0;
      }else if(c==2 && colorFlg==1){
        colorFlg = 0;
        c = 0;        
      }
      if(colorFlg==0){
        color = firstColor;
      }else {
        color = secondColor;
      }
      resultCalc(q+(i+1),qArray[i]["answer"],color);
      c++
    }


    function resultCalc(id,label,color) {
    let a1 = 0;
    let a2 = 0;
    let a3 = 0;
    let a4 = 0;
    let a5 = 0;
    for (i=0; i<=memberNum-1; i++) {
      const answer = rsArray[i][id];
      if(answer == 1){
        a1++;
      }else if(answer == 2){
        a2++;
      }else if(answer == 3){
        a3++;
      }else if(answer == 4){
        a4++;
      }else if(answer == 5){
        a5++;
      }

    }

    const ctx = document.getElementById(id);
    const chart = new Chart(ctx, {
      type: 'pie', // 円グラフを使用
      data: {
        labels: label,
        datasets: [{
          backgroundColor: color,
          data: [a1, a2, a3, a4, a5]
        }]
      },
      options: {
          }
    });
    chart.canvas.parentNode.style.width = '400px';
    chart.canvas.parentNode.style.height = '450px';

    }
   
  </script>

</body>
</html>