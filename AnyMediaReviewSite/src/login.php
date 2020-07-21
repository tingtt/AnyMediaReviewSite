<!--ログイン-->

<!DOCTYPE html>
<html>
    <head>
        <title>AMRS</title>
        <meta charset="Shift_JIS">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="login.css" media="all">
    </head>

    <body>
        <div id="form">
    <center>
        <h1 class="title">ログイン</h1>
        <form action="menu.jsp" method="post">
            <p class="un">UserID</p>
            <p class="user"><input class="userID" type=text name=name placeholder=""></P>        <!--ユーザー名入力-->
            <p class="pw">Password</p>
            <p class="pass"><input class="password" type=password name=pass placeholder=""></P>  <!--パスワード入力-->
            <input class="submit" type="submit" value="Login" />
        </form>
    </center>
        </div>
    </body>
</html>