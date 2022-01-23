<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>データ登録</title>
  <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- index.phpから受け取る -->
<?php
  $title = $_POST['title'];//ポストで受け取れる
  $author = $_POST['author'];
  //略
  $html = $title. $author;
  
  header('Content-type: text/html');//指定されたデータタイプに応じたヘッダーを出力する
  echo json_encode( $html );
?>

<!-- index.phpの値をフォームに飛ばす -->

<!-- 登録[Start] -->
<form method="post"  action = "insert.php">
<fieldset>
<legend>登録フォーム</legend>
    <label>書籍名：<input type="text" name="title"></label><br>
    <label>著者：<input type="text" name="author"></label><br>
    <label>書籍コメント<textArea name="comment" rows="4" cols="40"></textArea></label><br>
    <input type="submit" value="送信">
</fieldset> 
</form>
<!-- 登録[End] -->

<a href="k_index.php">Google Books検索</a>
<br>
<a href="select.php">登録リスト</a>


</body>
</html>