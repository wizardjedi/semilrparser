<?php

class ParseToken
{
    protected $ruleName;
    protected $values;
    protected $id;

    public static function create($name, $values) {
        return new ParseToken($name, $values);
    }

    /**
     * ParseToken constructor.
     * @param $ruleName
     * @param $values
     */
    public function __construct($ruleName, $values)
    {
        $this->ruleName = $ruleName;
        $this->values = $values;
        $this->id = str_replace('.','', uniqid($this->ruleName, true));
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

    public function toDot($depth) {
        /*if ($depth>20) {
            return '';
        }*/

        $s = $this->id.'[label="'.$this->id.'"];'."\n";

        foreach ($this->values as $value) {
            if ($value instanceof ParseToken) {
                $s .= $value->toDot($depth+1)."\n";

                $s .= $this->id.' -- '.$value->id.';'."\n";
            } else {
                $id = uniqid('scalar');

                $s .= $id.'[label="'.$value.'"]'."\n";

                $s .= $this->id.' -- '.$id.';'."\n";
            }
        }

        return $s;
    }
}