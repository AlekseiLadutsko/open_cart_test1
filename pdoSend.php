<?php
    session_start();
    $dsn = 'mysql:dbname=catalog;host=127.0.0.1';
    $user = 'root';
    $password = '';

    $getCategory = $_POST['productCategory'];
    $getBrand = $_POST['productBrand'];
    $getType = $_POST['productType'];
    $getPrice = $_POST['productPrice'];

    try {
        $dbh = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        $sql = 'SELECT `category_id` FROM `category` WHERE `category_name` = :category_name';
        $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':category_name' => $getCategory));
        $categoryIDQuery = $sth->fetch(PDO::FETCH_ASSOC)['category_id'];

        $countProduct = $dbh->exec("INSERT INTO `product` (`product_manuf`,`product_type`,`product_prices`,`category_id`) 
                                            VALUES('$getBrand','$getType','$getPrice','$categoryIDQuery')");
        header('Location: '.$_SERVER['HTTP_REFERER']);
        $_SESSION['message'] = "Продуктов добавлено ".$countProduct;
    } catch (PDOException $e) {
        echo 'Возникла ошибка при запросе к базе: ' . $e->getMessage();
    }