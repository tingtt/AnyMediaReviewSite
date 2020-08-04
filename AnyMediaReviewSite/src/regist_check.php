<?php

if (!isset($_POST['id'])) {
    header('Location:register.php');
}

$input_id = htmlspecialchars($_POST['id']);
$input_pass = htmlspecialchars($_POST['pass']);

/**
 * Undocumented function
 *
 * @param String $id
 * @return array(Bool,String stasus)
 */
function verify_regist(String $id)
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

    if ($row_num == 0) {
        return array(true, '');
    } else {
        return array(false, 'Used ID entered.');
    }
}

$verify = verify_login($input_id, $input_pass);

if ($verify[0]) {
    $_SESSION['user_id'] = $input_id;
    $_SESSION['password'] = $input_pass;
    header('Location:account_settings.php');
} else {
    header('Location:register.php?status=' . $verify[1]);
}
