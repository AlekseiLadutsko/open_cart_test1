<?php
$dsn = 'mysql:dbname=example_1;host=127.0.0.1';
$user = 'root';
$password = '';

$getLogin = $_POST['login'];
$getPass = $_POST['pass'];
$getName = $_POST['userName'];
$getSurName = $_POST['userSurName'];

try {
    $dbh = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $countUser = $dbh->exec("INSERT INTO `users` SET `login` = '$getLogin', `password` = '$getPass'");
    //$getUserIDQuery = $dbh->query("SELECT `user_id` FROM `users` WHERE `login` = '$getLogin' AND `password` = '$getPass'");
    //$userID = $getUserIDQuery->fetch(PDO::FETCH_ASSOC)['user_id'];
    $userID = $dbh->lastInsertId();
    $countUserInfo = $dbh->exec("INSERT INTO `userinfo` SET `name` = '$getName', `surname` = '$getSurName', `user_id` = '$userID'");
    echo 'Добавлено строк в таблицу Users = '.$countUser.'<br>';
    echo 'Добавлено строк в таблицу UserInfo = '.$countUserInfo;

} catch (PDOException $e) {
    echo 'Возникла ошибка при запросе к базе: ' . $e->getMessage();
}


?>