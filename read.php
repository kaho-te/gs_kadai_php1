<?php 
$filename = "data/result.csv";
$fp = fopen($filename, "r");

$phpResult = [];
while(!feof($fp)){
  $ary = explode(",", fgets($fp));
  $keyVal = array('date'=>$ary[0]);
  $keyVal += array('name'=>$ary[1]);
  $keyVal += array('q1'=>$ary[2]);
  $keyVal += array('q2'=>$ary[3]);
  $keyVal += array('q3'=>$ary[4]);
  $keyVal += array('q4'=>$ary[5]);
  $keyVal += array('comment'=>str_replace(array("\r", "\n"), '', $ary[6]));
  array_push($phpResult, $keyVal);
}

fclose($fp);

$jsonArray = json_encode($phpResult);


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
      <div class="upper_result">
        <div class="answer_area">
          <p class="question">Q1：初対面の時の印象は？</p>
          <canvas id="q1">
        </div>
        <div class="answer_area">
          <p class="question">Q2：初対面の時の話しやすさは？</p>
          <canvas id="q2">
        </div>
      </div>
      <div class="lower_result">
        <div class="answer_area">
          <p class="question">Q3：現在の印象は？</p>
          <canvas id="q3">
        </div>
        <div class="answer_area">
          <p class="question">Q4：現在の話しやすさは？</p>
          <canvas id="q4">
        </div>
      </div>
    </div>
    
    <div>
      <h2>コメント</h2>
      <ul id="comment">
        <?php for($i=0; $i<count($phpResult)-1; $i++){ ?>
          <?php if(!empty($phpResult[$i]["comment"])){?>
            <li>
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
    const impLabel = ["真面目", "面白い", "性格悪い", "怖い", "興味ない"];
    const contactLabel = ["とても話しやすい","やや話しやすい","やや話しにくい","とても話しにくい","興味ない"];
    const firstColor = ["#254278","#006bbe","#7ec8ef","#ede8e4","#c1afa8"];
    const nowColor = ["#810023","#BB1945","#F97EA0","#ede8e4","#c1afa8"];
    const jsJson = '<?php echo $jsonArray; ?>';
    let cleanJsonAry = jsJson.replace(/[\u0000-\u0019]+/g, "");
    const jsArray = JSON.parse(cleanJsonAry);
    const memberNum = jsArray.length;

    resultCalc("q1",impLabel,firstColor);
    resultCalc("q2",contactLabel,firstColor);
    resultCalc("q3",impLabel,nowColor);
    resultCalc("q4",contactLabel,nowColor);

    function resultCalc(id,label,color) {
    let a1 = 0;
    let a2 = 0;
    let a3 = 0;
    let a4 = 0;
    let a5 = 0;
    for (i=0; i<=memberNum-1; i++) {
      const answer = jsArray[i][id];
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
    chart.canvas.parentNode.style.width = '350px';
    chart.canvas.parentNode.style.height = '450px';

    }
   
  </script>

</body>
</html>