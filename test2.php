<?php

include("src/SimpleParser.php");

$rule = Rule::create('NUMBER', array(Ref::create('DIGIT')));

$input = array(new Digit('DIGIT'));

$res = $rule->reduce($input);

var_dump($res);