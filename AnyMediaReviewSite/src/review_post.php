<!--レビューを投稿-->

<!DOCTYPE html>
<html>

<head>
    <title>AMRS</title>
</head>

<body>
    <div id="review_post_form">
        <h1　class="title">投稿ページ</h1>
        <form action="" method="post">
            <p>
                <div>カテゴリー</div>
                <select id="category">
                    <option value="1">レディース</option>
                    <option value="2">メンズ</option>
                    <option value="3">ベビー・キッズ</option>
                    <option value="4">インテリア・住まい・小物</option>
                    <option value="5">本・音楽・ゲーム</option>
                    <option value="6">おもちゃ・ホビー・グッズ</option>
                    <option value="7">コスメ・香水・美容</option>
                    <option value="8">家電・スマホ・カメラ</option>
                    <option value="9">スポーツ・レジャー</option>
                    <option value="10">自動車・オートバイ</option>
                    <option value="11">その他</option>
                </select>
            </p>

            <p>
                <div>商品名</div>
                <select id="product_name">
                </select>
                <button type="button" id="add_btn" value="" name="">＋</button>
                <div id="parent">
                    <div id="text_add"></div>
                </div>


            </p>
            <input type="submit" id="review_post" value="投稿" />
        </form>
    </div>
    <script type="text/javascript" src="js/review_post.js"></script>
</body>

</html>