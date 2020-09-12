<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location:login.php');
}

if (!isset($_POST['category'])) {
    header('Location:menu.php');
}

function PDO_function_select(String $sql, $input_parameters = null)
{
    // connect
    $dns = 'mysql:dbname=amrs2;host=127.0.0.1';
    $user = 'root';
    $password = '';
    try {
        $db_handle = new PDO($dns, $user, $password);
    } catch (PDOexception $th) {
        return false;
    }

    $stmt = $db_handle->prepare($sql);

    $flag = $stmt->execute($input_parameters);

    if (!$flag) {
        return false;
    }

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function create_category_list($category, $nest = false)
{
    $list = array();
    if (!$nest) {
        $category = PDO_function_select("SELECT id FROM category WHERE parent_id = ?", array($category));
    }
    foreach ($category as $value) {
        $subs = PDO_function_select("SELECT id FROM category WHERE parent_id = ?", array($value['id']));
        array_push($list, $value['id']);
        if (count($subs) > 0) {
            $subs_of_sub = create_category_list($subs, true);
            foreach ($subs_of_sub as $sub) {
                array_push($list, $sub);
            }
        }
    }
    return $list;
}

$category_list = create_category_list($_POST['category']);

$target_list = PDO_function_select(
    "SELECT target.id, target.name, price, maker.name FROM target, maker WHERE target.maker_id = maker.id category_id IN (" . substr(str_repeat(',?', count($category_list)), 1) . ")",
    $category_list
)

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>AMRS - Search</title>
</head>

<body>
    <div class="content">

    </div>
</body>

</html>