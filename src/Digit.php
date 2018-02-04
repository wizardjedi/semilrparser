<?php

class Digit extends Rule {
    /**
     * Digit constructor.
     */
    public function __construct($name)
    {
        $this->ruleName = $name;


    }

    public static function create($name)
    {
        return new Digit($name);
    }

    public function getMaxTokens()
    {
        return 1;
    }

    public function getDefinition() {
        return $this->ruleName.'[0..9]';
    }

    public function reduce($inputTokens)
    {
        $val = $inputTokens[0];

        if (in_array($val, array('0','1','2','3','4','5','6','7','8','9'))) {
            $c = ParseToken::create($this->getRuleName(), array( (int)$val ));

            return $c;
        }

        return null;
    }

    public function toDot()
    {
        return $this->id.'[label="'.$this->values[0].'"]';
    }
}