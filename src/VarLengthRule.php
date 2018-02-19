<?php

class VarLengthRule extends Rule
{
    protected $start;
    protected $finish;

    /**
     * VarLengthRule constructor.
     */
    public function __construct($name, $start, $finish)
    {
        parent::__construct($name, array($start));

        $this->start = $start;
        $this->finish = $finish;
    }

    public function reduce($inputTokens, $index, $allTokens, $parser)
    {
        if (($allTokens[$index])->getRuleName()) {
            $i = $index + 1;

            while ($allTokens) {

            }
        }
    }
}