<?php

class Token
{
    protected $symbol;

    /**
     * Token constructor.
     */
    public function __construct($symbol)
    {
        $this->symbol = $symbol;
    }

    /**
     * Shortcut method
     *
     * @param $symbol
     * @return Token
     */
    public static function i($symbol)
    {
        return new Token($symbol);
    }

    public static function create($symbol)
    {
        return new Token($symbol);
    }

    public function __toString()
    {
        return 'T<'.$this->symbol.'>';
    }
}