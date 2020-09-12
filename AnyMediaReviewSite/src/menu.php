<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location:login.php');
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

function category_option_nest(DOMDocument $domDocument, $categories, $nest_level = 0)
{
    $category_option_nodes = array();

    foreach ($categories as $value) {
        $nest_tag = '';
        for ($i = 0; $i < $nest_level; $i++) {
            $nest_tag .= '&emsp;';
        }
        $domElement = $domDocument->createElement('option', $nest_tag . $value['name']);

        // valueの値
        $domAttribute = $domDocument->createAttribute('value');
        $domAttribute->value = $value['id'];
        $domElement->appendChild($domAttribute);

        // ネストレベル情報を付加
        $domAttribute = $domDocument->createAttribute('nest_level');
        $domAttribute->value = $nest_level;
        $domElement->appendChild($domAttribute);

        // クラス情報を付加
        $domAttribute = $domDocument->createAttribute('class');
        $domAttribute->value = 'category_options';
        $domElement->appendChild($domAttribute);

        array_push($category_option_nodes, $domElement);

        // サブカテゴリが存在するなら再帰呼び出し
        $sub_categories = PDO_function_select('SELECT id, name, parent_id FROM category WHERE parent_id = ? ORDER BY id', array($value['id']));
        if (count($sub_categories) > 0) {
            // サブカテゴリを取得
            $sub_category_option_nodes  = category_option_nest($domDocument, $sub_categories, $nest_level + 1);
            // サブカテゴリを追加
            foreach ($sub_category_option_nodes as $sub_node) {
                array_push($category_option_nodes, $sub_node);
            }
        }
    }

    if ($nest_level > 0) {
        return $category_option_nodes;
    }

    foreach ($category_option_nodes as $node) {
        $domDocument->appendChild($node);
    }
    return $domDocument;
}

// get categories
$categories = PDO_function_select('SELECT id, name, parent_id FROM category WHERE parent_id IS NULL ORDER BY id');
$category_option_nodes = category_option_nest(new DOMDocument('1.0', "UTF-8"), $categories);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>AMRS - Menu</title>
</head>

<body>
    <div class="content">
        <form action="search.php" method="post">
            <button type="submit">Search</button><br>
            <input type="search" name="keywords" placeholder="Keywords"><br>
            <div id="selectors">
                <select name="category" id="category_selector" aria-placeholder="カテゴリを選択">
                    <!-- カテゴリのオプション -->
                    <?= $category_option_nodes->saveXML() ?>
                </select><br>
            </div>
        </form>
    </div>

    <script>
        window.onload = function() {
            category_selector = document.getElementById('category_selector');

            category_options = Array.from(document.getElementsByClassName('category_options'));
            category_options.forEach(element => {
                if (element.getAttribute('nest_level') >= 2) {
                    //element.hidden = true;
                }
            });
        }

        category_selector.onchange = function() {
            console.log('onchange');
            var category_options = Array.from(document.getElementsByClassName('category_options'));
            var selected_value = category_selector.value;

            var selected_nest_level = 0,
                buf = 0,
                contain_selected_flg = false;
            for (let index = 0; index < category_options.length; index++) {
                const element = category_options[index];
                console.log(index, element.getAttribute('nest_level'), contain_selected_flg, buf);
                var hidden_flg = false;
                // ネストされていて
                // if (element.getAttribute('nest_level') == 0) {

                // } else {
                // 選択されたオプションを所持しているか
                if (contain_selected_flg) {
                    if (element.getAttribute('nest_level') > Number(selected_nest_level) + 2) {
                        hidden_flg = true;
                    }
                    if (category_options[index + 1].getAttribute('nest_level') == 0) {
                        contain_selected_flg = false;
                    }
                } else {
                    // 直前がネストレベル0のオプションならindexを保持
                    if (index > 0 && category_options[index - 1].getAttribute('nest_level') == 0) {
                        buf = index;
                    }
                    // 選択されたオプションなら
                    if (element.value == selected_value) {
                        contain_selected_flg = true;
                        selected_nest_level = element.getAttribute('nest_level');
                        index = buf;
                        continue;
                    }
                    // ネストレベルが0より大きくて選択されたオプションを保持していない場合
                    if (element.getAttribute('nest_level') > 0) {
                        hidden_flg = true;
                    }
                }
                // }
                element.hidden = hidden_flg;
            }
        };
    </script>
</body>

</html>

<!--
    a
        a0
            a00
        a1
            a10
    b
        b0
        b1
            b10
                b100
-->