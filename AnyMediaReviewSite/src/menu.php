<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location:login.php');
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>AMRS - Menu</title>
</head>

<body>
    <div class="content">
        <button onclick="location.href='search.php'">探す</button>
        <button onclick="location.href='review.php'">レビューする</button>
    </div>
</body>

</html>