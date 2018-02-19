<?php

include("Rule.php");
include("Digit.php");
include("Ref.php");
include("ParseToken.php");
include("VarLengthRule.php");

class SimpleParser {
    protected $rules = array();

    /**
     * SimpleParser constructor.
     */
    public function __construct()
    {
        $rules = array(
            Rule::create('LB', array('(')),
            Rule::create('RB', array(')')),
            Rule::create('OP_PLUS', array('+')),
            Rule::create('OP_MINUS', array('-')),
            Rule::create('OP_MUL', array('*')),
            Rule::create('OP_DIV', array('/')),
            Digit::create('DIGIT'),
        //    VarLengthRule::create('BLOCK', Ref::create('LB'), Ref::create('RB')),
            Rule::create('NUMBER', array(Ref::create('DIGIT'))),
            Rule::create('NUMBER', array(Ref::create('NUMBER'), Ref::create('NUMBER'))),
            Rule::create('MULT', array(Ref::create('NUMBER'))),
            Rule::create('MULT', array(Ref::create('MULT'), Ref::create('OP_MUL'), Ref::create('MULT'))),
            Rule::create('MULT', array(Ref::create('LB'), Ref::create('ADD'), Ref::create('RB'))),
            Rule::create('ADD', array(Ref::create('MULT'))),
            Rule::create('ADD', array(Ref::create('ADD'), Ref::create('OP_PLUS'),Ref::create('ADD'))),
        );

        $this->rules = $rules;
    }


    public function parseString($string)
    {
        $input = preg_split('//', $string, -1, PREG_SPLIT_NO_EMPTY);

        return $this->parseInput($input);
    }

    public function parseInput($input) {
        $reduced = true;
        while ($reduced) {
            $reduced = false;

            foreach ($this->rules as $rule) {
                echo "Processing rule".$rule->getDefinition()."\n";

                $maxTokens = $rule->getMaxTokens();

                $lastIndex = 0;
                $newInput = array();
                for ($i=0;$i<count($input) - $maxTokens + 1;$i++,$lastIndex++) {
                    $inputTokens = array_slice($input, $i, $maxTokens);

                    $result = $rule->reduce($inputTokens);
                    if ($result != null) {
                        list($count, $resultToken) = $result;

                        $newInput[] = $resultToken;
                        $lastIndex += $count;
                        $reduced = true;
                        break;
                    } else {
                        $newInput[] = $input[$i];
                    }
                }

                if ($lastIndex < count($input)) {
                    for ($i = $lastIndex;$i<count($input);$i++) {
                        $newInput[] = $input[$i];
                    }
                }

                if ($reduced) {
                    echo "Break\n";
                    $input = $newInput;
                    echo "New input\n";

                    print_r($input);

                    break;
                }
            }
        }

        return $input;
    }
}