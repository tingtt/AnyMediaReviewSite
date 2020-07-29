<!--ログイン-->

<?php

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}

if (isset($_GET['status'])) {
    $status = $_GET['status'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>AMRS - Login</title>
    <link rel="stylesheet" href="login.css" media="all">
</head>

<body>
    <div id="form">
        <div class="center">
            <h1 class="title">ログイン</h1>
            <form action="login_check.php" method="post">
                <!--ユーザー名入力-->
                <p class="user"><input type=text name=id placeholder="UserID"><?= $user_id ?></p>
                <!--パスワード入力-->
                <p class="pass"><input type=password name=pass placeholder="Password"></p>
                <input class="submit" type="submit" value="Login" />
                <font color='red'><?= $status ?></font>
            </form>
        </div>
    </div>
</body>

</html>