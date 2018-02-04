<?php

ini_set('xdebug.max_nesting_level', 2000);

include("src/SimpleParser.php");

$parser = new SimpleParser();

//$result = $parser->parse('12+2*3+4*4+2+3+7*7+1');
//$result = $parser->parse('1+2');
$result = $parser->parse('1+2*3');

echo "-----";

//var_dump($result);
echo $result[0]->toDot(0);