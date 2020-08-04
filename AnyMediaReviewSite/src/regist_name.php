<?php

if (!isset($_SESSION['user_id']) || !isset($_SESSION['password'])) {
    header('Location:register.php');
}

function insert_account_info(String $id, String $name, String $pass)
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

    $sql = 'INSERT INTO accounts (id, name, pass) VALUES(?, ?, ?)';
    $stmt = $db_handle->prepare($sql);

    $flag = $stmt->execute(array($id, $name, $pass));

    if (!$flag) {
        header('Location:register.php?status=' . "Error: Cannot registration.");
    }
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
        <form action="regist_name" method="post">
            <h3>名前を入力してください。</h3>
            <input type="text" placeholder="Name">
            <button type="submit">決定</button>
            <p>※ ここで設定した名前はサイトを利用する時に他のユーザにも表示されます。</p>
        </form>
    </div>
</body>

</html>