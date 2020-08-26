<?php
session_start();

// post送信されている場合の処理
if (isset($_POST['id'])) {
    $input_id = $_POST['id'];
    $hashed_pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);

    /**
     * Undocumented function
     *
     * @param String $id
     * @param String $pass
     * @return array(Bool,String) array[1] = Error status
     */
    function verify_login($id, $pass)
    {
        // connect
        $dns = 'mysql:dbname=amrs;host=127.0.0.1';
        $user = 'root';
        $password = '';
        try {
            $db_handle = new PDO($dns, $user, $password);
        } catch (PDOexception $th) {
            return array(false, 'Error: Cannot connect DB');
        }

        $sql = 'SELECT * FROM accounts WHERE id = :id';
        $prepare = $db_handle->prepare($sql);
        $prepare->bindValue(':id', $id, PDO::PARAM_STR);

        $prepare->execute();

        $row_num = $prepare->rowCount();
        if ($row_num <= 0) {
            return array(false, 'No exist ID entered.');
        }
        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        if ($result[0]['pass'] != $pass) {
            return array(false, 'Wrong password entered.');
        }

        return array(true, '');
    };

    $verify = verify_login($input_id, $hashed_pass);

    if ($verify[0]) {
        $_SESSION['user_id'] = $input_id;
        header('Location:menu.php');
    } else {
        $status = $verify[1];
    }
}

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
            <form action="login.php" method="post">
                <!--ユーザー名入力-->
                <input type=text name=id placeholder="User ID" value="<?= $user_id ?>"><br>
                <!--パスワード入力-->
                <input type=password name=pass placeholder="Password"><br>
                <p color='red'><?= $status ?></p><br>
                <input type="submit" value="Login" />
                <a href="register.php">Create account</a>
            </form>
        </div>
    </div>
</body>

</html>