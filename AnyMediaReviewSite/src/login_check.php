<?php

if (!isset($_POST['id'])) {
    header('Location:login.php');
}

$input_id = htmlspecialchars($_POST['id']);
$input_pass = htmlspecialchars($_POST['pass']);

/**
 * Undocumented function
 *
 * @param String $id
 * @param String $pass
 * @return array(Bool,String stasus)
 */
function verify($id, $pass)
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

    $_SESSION['user_id'] = $id;
    return array(true, '');
};

$verify = verify($input_id, $input_pass);

if ($verify[0]) {
    header('Location:timeline.php');
} else {
    header('Location:Login.php?status=' . $verify[1]);
}
