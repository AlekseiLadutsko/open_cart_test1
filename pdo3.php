<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
$dsn = 'mysql:dbname=catalog_example;host=127.0.0.1';
$user = 'root';
$password = '';

try {
    $dbh = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $sql = 'SELECT product_id, product_manuf, product_type, product_prices
    FROM `product`
    WHERE product_prices > :prices';
    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $sth->execute(array(':prices' => 1200));
    $products = $sth->fetchAll(PDO::FETCH_ASSOC);
    echo '<pre>';
    print_r($products);

} catch (PDOException $e) {
    echo 'Возникла ошибка при запросе к базе: ' . $e->getMessage();
}


?>
</body>
</html>