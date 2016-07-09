<?php

require_once $_SERVER['DOCUMENT_ROOT']."/variables/variable.php";

class Triad {
    
    private $_first;
    private $_second;
    private $_third;

    public function __construct(Variable $first, Variable $second, Variable $third) {
        $this->_first = $first;
        $this->_second = $second;
        $this->_third = $third;
    }

    public function correctEntry($first, $second, $third) {
        return ($this->_first->attached($first) && $this->_second->attached($second) && $this->_third->attached($third));
    }

}