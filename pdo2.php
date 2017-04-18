<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
$dsn = 'mysql:dbname=catalog_example;host=127.0.0.1';
$user = 'root';
$password = '';

class Products
{
    private $product_id;
    private $product_manuf;
    private $product_type;
    private $product_price;

    public function __construct()
    {
    }

    public function __toString()
    {
        return 'id товара = '.$this->product_id.'<br>'.'Производитель товара = '.$this->product_manuf.'<br>'.'Модель товара = '.$this->product_type.'<br>'.'Цена товара = '.$this->product_price.'<br>'.'<br>';
    }
}

try {
    $dbh = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $sth = $dbh->query("SELECT * FROM product");
    $sth->setFetchMode(PDO::FETCH_CLASS, 'Products');
    while ($product = $sth->fetch()){
        print($product);
    };

    $dbh->exec("ALTER TABLE product CHANGE COLUMN product_price product_prices FLOAT NOT NULL");

} catch (PDOException $e) {
    echo 'Возникла ошибка при запросе к базе: ' . $e->getMessage();
}


?>
</body>
</html>