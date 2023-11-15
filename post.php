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
    <h1>アンケート</h1>
    <button onclick="location.href='./read.php'">結果を表示</button>
  </header>
  <main>
    <form action="write.php" method="post">
      <div>
        <p class="question required">回答者の名前</p>
        <input type="text" name="name" required>
      </div>
      <div class="question_area">
        <p class="question required">Q1：初対面の時の印象は？</p>
        <input type="radio" name="q1" value="1" checked>真面目
        <input type="radio" name="q1" value="2">面白い
        <input type="radio" name="q1" value="3">性格悪い
        <input type="radio" name="q1" value="4">怖い
        <input type="radio" name="q1" value="5">興味ない
      </div>

      <div class="question_area">
        <p class="question required">Q2：初対面の時の話しやすさは？</p>
        <input type="radio" name="q2" value="1" checked>とても話しかけやすい
        <input type="radio" name="q2" value="2">やや話しかけやすい
        <input type="radio" name="q2" value="3">やや話しかけにくい
        <input type="radio" name="q2" value="4">とても話しかけにくい
        <input type="radio" name="q2" value="5">興味ない
      </div>

      <div class="question_area">
        <p class="question required">Q3：現在の印象は？</p>
        <input type="radio" name="q3" value="1" checked>真面目
        <input type="radio" name="q3" value="2">面白い
        <input type="radio" name="q3" value="3">性格悪い
        <input type="radio" name="q3" value="4">怖い
        <input type="radio" name="q3" value="5">興味ない
      </div>

      <div class="question_area">
        <p class="question required">Q4：現在の話しやすさは？</p>
        <input type="radio" name="q4" value="1" checked>とても話しかけやすい
        <input type="radio" name="q4" value="2">やや話しかけやすい
        <input type="radio" name="q4" value="3">やや話しかけにくい
        <input type="radio" name="q4" value="4">とても話しかけにくい
        <input type="radio" name="q4" value="5">興味ない
      </div>

      <div class="question_area">
        <p class="question">最後に、応援コメントをお願いします！</p>
        <textarea type="text" name="comment"></textarea>  
      </div>
      
	    <input type="submit" value="送信">
     </form>
  </main>


</body>
</html>