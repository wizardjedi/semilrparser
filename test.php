<?php

ini_set('xdebug.max_nesting_level', 2000);

include("src/SimpleParser.php");

$parser = new SimpleParser();

//$result = $parser->parseString('12+2*3+4*4+2+3+7*7+1');
$result = $parser->parseString('1+(2+3)');
//$result = $parser->parseString('1+2*(3+2)+4');

print_r($result);

echo "-----";

//var_dump($result);
file_put_contents('1.dot',"graph grp {\n".$result[0]->toDot(0)."\n}");