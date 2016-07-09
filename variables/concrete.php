<?php

require_once "variable.php";

class ConcreteVariable implements Variable {
    private $_probability;
    private $_concreteValue;

    public function __construct($concreteValue) {
        $this->_concreteValue = $concreteValue;
    }

    public function attached($value) {
        return ($value == $this->_concreteValue);
    }
}