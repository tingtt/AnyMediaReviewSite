<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location:register.php');
}

if (isset($_POST['name'])) {
    $_SESSION['name'] = htmlspecialchars($_POST['name']);
    header('Location:regist_pass.php');
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>AMRS - Register</title>
</head>

<body>
    <div class="content">
        <form action="regist_name.php" method="post">
            <h3>名前を入力してください。</h3>
            <input type="text" placeholder="Name" name="name">
            <button type="submit">決定</button>
            <p>※ ここで設定した名前は当サイトを使用するときに他のユーザにも表示され、変更可能です。</p>
        </form>
    </div>
</body>

</html>