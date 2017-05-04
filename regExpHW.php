<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
    <?php
        $filename = "html_to_parse.txt";
        $handle = fopen($filename, "r+");
        $contents = fread($handle, filesize($filename));
        //$contents = mb_convert_encoding($contents, 'cp1251');

        fclose($handle);
        //$contents = str_replace(PHP_EOL, '', $contents);
        //print '<plaintext>';
        //echo $contents;

        $mask = '/("attr__name">|<\/span>)[\n\s]*(?<mark>.*)[\n\s]*<\/span>[\n\s]*<span class="attr__value">(?<attrValue>.*)<\/span>/iu';

        preg_match_all($mask,$contents,$result);

        for ($i = 0; $i < count($result['mark']); $i++){
            echo $result['mark'][$i].': '.$result['attrValue'][$i].'<br/>';
        }
    ?>
</body>
</html>