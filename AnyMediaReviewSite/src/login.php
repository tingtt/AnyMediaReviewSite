<!--ログイン-->

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
                <p class="user"><input class="userID" type=text name=name placeholder="Username"></P>
                <!--パスワード入力-->
                <p class="pass"><input class="password" type=password name=pass placeholder="Password"></P>
                <input class="submit" type="submit" value="Login" />
            </form>
        </div>
    </div>
</body>

</html>