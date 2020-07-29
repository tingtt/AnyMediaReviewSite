<!--ユーザ登録-->

<?php
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>AMRS - Register</title>
</head>

<body>
    <h1 id="title">Register</h1>
    <div class="form">
        <form action="regist_check.php" method="post">
            <input type="text" name="id" placeholder="User ID"><?= $user_id ?><br>
            <input type="password" name="pass" placeholder="Password"><br>
            <input type="password" name="pass_check" placeholder="Password verify"><br>
            <font color='red'><?= $status ?></font><br>
            <input type="submit" value="Regist">
            <a href="login.php">Login</a>
        </form>
    </div>
</body>

</html>