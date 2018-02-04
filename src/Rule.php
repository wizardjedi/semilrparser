<?php

class Rule {
    protected $id;
    protected $ruleName;
    protected $tokens;
    protected $values;

    public static function create($name, $tokens) {
        return new Rule($name, $tokens);
    }

    /**
     * Rule constructor.
     * @param $ruleName
     * @param $tokens
     */
    public function __construct($ruleName, $tokens)
    {
        $this->ruleName = $ruleName;
        $this->tokens = $tokens;

        $this->id = str_replace('.','', uniqid($this->ruleName, true));
    }

    public function getMaxTokens() {
        return count($this->tokens);
    }

    public function getDefinition() {
        return $this->ruleName.'['.implode($this->tokens).']';
    }

    public function reduce($inputTokens) {
        echo "---Rule:reduce--\n";

        if (count($inputTokens) != count($this->tokens)) {
            echo "Count differs return null\n";

            return null;
        }

        for ($i=0;$i<count($this->tokens);$i++) {
            $inputT = $inputTokens[$i];
            $t = $this->tokens[$i];

            if (
                $t instanceof Ref
                && $inputT instanceof ParseToken
                && $t->getRuleName() != $inputT->getRuleName()
            ) {
                echo "Different reference return null\n";

                return null;
            }

            if (
                !($t instanceof Ref)
                && $t != $inputT
            ) {
                echo "Tokens different return null\n";

                return null;
            }
        }

        $c = ParseToken::create($this->getRuleName(), $inputTokens);

        echo "values\n";
        var_dump($inputTokens);

        echo "---Rule:reduce--\n";

        return $c;
    }

    /**
     * @return mixed
     */
    public function getRuleName()
    {
        return $this->ruleName;
    }

    /**
     * @param mixed $ruleName
     */
    public function setRuleName($ruleName)
    {
        $this->ruleName = $ruleName;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getTokens()
    {
        return $this->tokens;
    }

    /**
     * @param mixed $tokens
     */
    public function setTokens($tokens)
    {
        $this->tokens = $tokens;
    }

    /**
     * @return mixed
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param mixed $values
     */
    public function setValues($values)
    {
        $this->values = $values;
    }
}