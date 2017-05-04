<?php
    session_start();
    ob_start();
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
    if(isset($_SERVER['HTTP_REFERER']) && isset($_SESSION['message'])){
        echo $_SESSION['message'];
    }
?>
<form action="pdoSend.php" method="post">
    <p>Category<span style="color:red">*</span></p>
    <select name = "productCategory">
        <?php
            $dsn = 'mysql:dbname=catalog;host=127.0.0.1';
            $user = 'root';
            $password = '';
            try {
                $dbh = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                $sql = 'SELECT `category_name` FROM `category`';
                $categoryQuery = $dbh->query($sql);
                $category = $categoryQuery->fetchAll(PDO::FETCH_ASSOC);
                foreach ($category as $value){
                    echo '<option value = "'.$value['category_name'].'">'.$value['category_name'].'</option>';
                }
            } catch (PDOException $e) {
                echo 'Возникла ошибка при запросе к базе: ' . $e->getMessage();
            }
        ?>
    </select>
    <p>Brand<span style="color:red">*</span></p>
    <input type = "text" name = "productBrand" required />
    <p>Type<span style="color:red">*</span></p>
    <input type = "text" name = "productType" required />
    <p>Price<span style="color:red">*</span></p>
    <input type = "text" name = "productPrice" required />
    <br>
    <br>
    <input type = "submit" name = "send" value = "Add" />
</form>
</body>
</html>