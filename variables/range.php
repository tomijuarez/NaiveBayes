<?php

require_once "variable.php";

class RangeVariable implements Variable {
    
    private $_minValue;
    private $_maxValue;

    private $_hasUpperBound = FALSE;

    public function __construct(/*args*/) {
        $args = func_get_args();

        $this->_minValue = $args[0];

        if (count($args) == 2) {
            $this->_hasUpperBound = TRUE;
            $this->_maxValue = $args[1];
        }
    }

    public function attached($value) {
        return ($this->_hasUpperBound) 
                ? $value >= $this->_minValue && $value < $this->_maxValue
                : $value >= $this->_minValue;
    }

}