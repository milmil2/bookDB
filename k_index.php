<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="./sample.css">
    <title>GoogleBook検索</title>
</head>
<body>

  <header>
   
  </header>

  <main>

    <div class="search">
      <p>本を検索できます</p>
      題名: <input type="text" id="keyword_title" value="">
      著者: <input type="text" id="keyword_author" value="">
      <button id="readbook">検索</button>
      
    </div>

    <p><span class="total"></span></p>
    <button id="filter">出版日順で並べ替える</button>
    <p id="content">


    </p>
  </main>
</body>

<script src="./js/jquery-3.5.1.min.js"></script>
<script>
// 手順


// 「検索」
$("#readbook").on("click", function(){

  const keyword_title = $("#keyword_title").val();
  const keyword_author = $("#keyword_author").val();

  // 著者だけの場合
  if (keyword_title == ""){
    const qurl = "https://www.googleapis.com/books/v1/volumes?q=inauthor:" + keyword_author;
    $.get(qurl, function(data){
    const items = data.items;
    const totalItems = data.totalItems;
    const publishedDate = data.publishedDate;
  
    let view = "";

    // 0件の場合
    if(totalItems == 0){
      $("#content").html("");
      $(".total").html("該当がありません");
    // 1件以上ある場合
    }else {
      for( let i = 0; i<items.length; i++) {
      const item = items[i];
      const title = item.volumeInfo.title;
      const author = item.volumeInfo.authors;
      const publishedDate = item.volumeInfo.publishedDate;
      view += "<ul><li class='book'>題名:<span class='title'>" + title + "</span><br>著者：<span class='author'>" + author + "</span><br>出版日：<span class='pdate'> " + publishedDate + "</span><br><button class='save'>保存</button></li></ul>";
      }
      $("#content").html(view);
      $(".total").html(totalItems + "件中" + items.length + "件表示");
    };
  });
  // タイトルと著者の場合
  }else{
  const qurl = "https://www.googleapis.com/books/v1/volumes?q=intitle:" + keyword_title + "+inauthor:" + keyword_author;
  $.get(qurl, function(data){
  const items = data.items;
  const totalItems = data.totalItems;
  let view = "";

  if(totalItems == 0){
    $(".total").html("該当がありません");
    $("#content").html("");
  }else {
    for( let i = 0; i<items.length; i++) {
    const item = items[i];
    const title = item.volumeInfo.title;
    const author = item.volumeInfo.authors;
    const publishedDate = item.volumeInfo.publishedDate;
    view += "<ul><li class='book'>題名:<span class='title'>" + title + "</span><br>著者：<span class='author'>" + author + "</span><br>出版日：<span class='pdate'> " + publishedDate + "</span><br><button class='save'>保存</button></li></ul>";
  }
  $("#content").html(view);
  $(".total").html(totalItems + "件中" + items.length + "件表示");
  };
  
});
};
});


// 出版日順に並べ替え
$("#filter").on("click", function(){

  const keyword_title = $("#keyword_title").val();
  const keyword_author = $("#keyword_author").val();

  if (keyword_title == ""){
    const qurl = "https://www.googleapis.com/books/v1/volumes?q=inauthor:" + keyword_author + "&orderBy=newest";
    console.log(qurl);
    $.get(qurl, function(data){
  const items = data.items;
  const totalItems = data.totalItems;
  const publishedDate = data.publishedDate;
  console.log(totalItems);
  let view = "";

  if(totalItems == 0){
    $(".total").html("該当がありません");
    $("#content").html("");
  }else {
    for( let i = 0; i<items.length; i++) {
    const item = items[i];
    console.log(item);
    const title = item.volumeInfo.title;
    const author = item.volumeInfo.authors;
    const publishedDate = item.volumeInfo.publishedDate;
    view += "<ul><li class='book'>題名:<span class='title'>" + title + "</span><br>著者：<span class='author'>" + author + "</span><br>出版日：<span class='pdate'> " + publishedDate + "</span><br><button class='save'>保存</button></li></ul>";
  }
  $("#content").html(view);
  $(".total").html(totalItems + "件中" + items.length + "件表示");
  };
  
});
  }else{
  const qurl = "https://www.googleapis.com/books/v1/volumes?q=intitle:" + keyword_title + "+inauthor:" + keyword_author + "&orderBy=newest";
  $.get(qurl, function(data){
  const items = data.items;
  const totalItems = data.totalItems;
  console.log(totalItems);
  let view = "";

  if(totalItems == 0){
    $(".total").html("該当がありません");
    $("#content").html("");
  }else {
    for( let i = 0; i<items.length; i++) {
    const item = items[i];
    console.log(item);
    const title = item.volumeInfo.title;
    const author = item.volumeInfo.authors;
    const publishedDate = item.volumeInfo.publishedDate;
    view += "<ul><li class='book'>題名:<span class='title'>" + title + "</span><br>著者：<span class='author'>" + author + "</span><br>出版日：<span class='pdate'> " + publishedDate + "</span><br><button class='save'>保存</button></li></ul>";
  }
  $("#content").html(view);
  $(".total").html(totalItems + "件中" + items.length + "件表示");
  };
  
});
};
});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

// 保存ボタンを押したら
$(document).on("click",".save",function(){

  // タイトル＆著者を取得
  const b_title = $(this).parent().find(".title").text();
  const b_author = $(this).parent().find(".author").text();

  
  // confirm.phpに変数を渡す
  $.ajax({
      type: 'POST',
      dataType:'json',
      url:'confirm.php',
      data:{
        title : b_title,
        author : b_author
      },
      success:function(data) {
        console.log(data);
      },
      error:function(XMLHttpRequest, textStatus, errorThrown) {
      
      }
    });
});


</script>



</html>

