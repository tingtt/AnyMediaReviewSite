<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location:register.php');
}
if (!isset($_SESSION['name'])) {
    header('Locatoin:regist_name.php');
}

$status = "";

/**
 * 入力されたID、名前、パスワード（暗号化済）をデータベースに登録
 *
 * @param String $id
 * @param String $name
 * @param String $pass
 * @return array(boolean,String) array[1] = Error status
 */
function insert_account_info(String $id, String $name, String $pass)
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

    $sql = 'INSERT INTO account (id, name, password) VALUES(?, ?, ?)';
    $stmt = $db_handle->prepare($sql);

    $flag = $stmt->execute(array($id, $name, $pass));

    if (!$flag) {
        return array(false, 'Error: Statement cannot execute.');
    }

    return array(true, '');
}

if (isset($_POST['pass'])) {
    $id = $_SESSION['user_id'];
    $name = $_SESSION['name'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $flag = insert_account_info($id, $name, $pass);

    if (!$flag[0]) {
        $status = $flag[1];
    } else {
        header('Location:login.php');
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
        <form action="regist_pass.php" method="post">
            <h3>パスワードを設定します。</h3>
            <input type="password" name="pass" id="pass1"><br>
            <input type="password" id="pass2"><br>
            <font id="status" color="red"><?= $status ?></font><br>
            <button id="submit_btn" type="submit">設定</button>
        </form>
    </div>

    <script>
        // パスワード 2が変更されたらパスワード １と一致してるかチェック
        const pass1 = document.getElementById("pass1");
        const pass2 = document.getElementById("pass2");
        const status = document.getElementById("status");
        const submit = document.getElementById("submit_btn");
        pass2.addEventListener('change', () => {
            if (pass1.value != pass2.value) {
                console.log("dismatch");
                status.innerHTML = "Passwords were not match.";
                submit.disabled = true;
            } else {
                console.log("match");
                status.innerHTML = "";
                submit.disabled = false;
            }
        });
        pass1.addEventListener('change', () => {
            if (pass2.value != "") {
                if (pass1.value != pass2.value) {
                    console.log("dismatch");
                    status.innerHTML = "Passwords were not match.";
                    submit.disabled = true;
                } else {
                    console.log("match");
                    status.innerHTML = "";
                    submit.disabled = false;
                }
            }
        });
    </script>
</body>

</html>