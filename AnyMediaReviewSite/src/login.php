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
    <h1 id="title">Login</h1>
    <div id="form">
        <div class="center">
            <form action="login_check.php" method="post">
                <!--ユーザー名入力-->
                <input type=text name=id placeholder="User ID"><?= $user_id ?><br>
                <!--パスワード入力-->
                <input type=password name=pass placeholder="Password"><br>
                <font color='red'><?= $status ?></font><br>
                <input type="submit" value="Login" />
                <a href="register.php">Create account</a>
            </form>
        </div>
    </div>
</body>

</html>