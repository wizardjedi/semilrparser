<?php

class Ref {
    protected $ruleName;

    /**
     * Ref constructor.
     * @param $ruleName
     */
    public function __construct($ruleName)
    {
        $this->ruleName = $ruleName;
    }

    public static function create($ruleName) {
        return new Ref($ruleName);
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

    public function __toString()
    {
        return 'Ref['.$this->getRuleName().']';
    }
}