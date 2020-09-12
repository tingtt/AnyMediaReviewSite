<?php
session_start();

$status;

// post送信されている場合の処理
if (isset($_POST['id'])) {
    $input_id = $_POST['id'];

    /**
     * IDが使用可能か確認
     *
     * @param String $id
     * @return array(Bool,String stasus)
     */
    function verify_regist(String $id)
    {
        // connect
        $dns = 'mysql:dbname=amrs2;host=127.0.0.1';
        $user = 'root';
        $password = '';
        try {
            $db_handle = new PDO($dns, $user, $password);
        } catch (PDOexception $th) {
            return array(false, 'Error: Cannot connect DB');
        }

        $sql = 'SELECT * FROM account WHERE id = ?';
        $prepare = $db_handle->prepare($sql);

        $prepare->execute(array($id));

        $row_num = $prepare->rowCount();

        if ($row_num == 0) {
            return array(true, '');
        } else {
            return array(false, 'Entered ID already used.');
        }
    }

    $verify = verify_regist($input_id);

    $_SESSION['user_id'] = $input_id;

    if ($verify[0]) {
        header('Location:regist_name.php');
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
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>AMRS - Register</title>
</head>

<body>
    <h1 id="title">Register</h1>
    <div class="form">
        <form action="register.php" method="post">
            <input type="text" name="id" placeholder="User ID" value="<?= $user_id ?>"><br>
            <font id="status" color='red'><?= $status ?></font><br>
            <input type="submit" value="Regist">
            <a href="login.php">Login</a>
        </form>
    </div>
</body>

</html>