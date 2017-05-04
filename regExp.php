<?php
/*$str = 'bla bla kakadu@gmail.com bla bla';

$mask = '/[\w-_.]+@\w{2,7}.\w{2,}/i';

$strToReplace = '<a href="mailto:$0">$0</a>';

echo preg_replace($mask,$strToReplace,$str);*/

$str = 'bla bla kakadu@gmail.com bla bla';

$mask = '/(?<login>[\w-_.]+)@(?<host>\w{2,7}.\w{2,})/i';

preg_match($mask,$str,$result);

print '<pre>';

print_r($result);