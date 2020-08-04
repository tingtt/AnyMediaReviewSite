<!--ユーザ登録-->

<?php

if (session_status() == PHP_SESSION_DISABLED) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}

if (isset($_GET['status'])) {
    $status = $_GET['status'];
}

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
            <input id="pass1" type="password" name="pass" placeholder="Password"><br>
            <input id="pass2" type="password" name="pass_check" placeholder="Password verify"><br>
            <font id="status" color='red'><?= $status ?></font><br>
            <input id="submit" type="submit" value="Regist">
            <a href="login.php">Login</a>
        </form>
    </div>
</body>

</html>

<script>
    // パスワード 2が変更されたらパスワード １と一致してるかチェック
    const pass1 = document.getElementById("pass1");
    const pass2 = document.getElementById("pass2");
    const status = document.getElementById("status");
    const submit = document.getElementById("submit");
    pass2.addEventListener('change', () => {
        if (pass1.value != pass2.value) {
            console.log("dismatch");
            status.innerHTML = "Password not match.";
            submit.disabled = true;
        } else {
            console.log("match");
            status.innerHTML = "";
            submit.disabled = false;
        }
    });
</script>