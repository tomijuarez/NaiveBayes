<?php

require_once "variables/variable.php";

class Label {
    
    private $_labelName;
    private $_table;

    public function __construct($labelName, $table) { 
        $this->_labelName = $labelName;
        $this->_table = $table;
    }

    public final function getProbability($votes, $responseTime, $userTime) {
        return $this->_table->getProbability($votes, $responseTime, $userTime);
    }

    public function getLabelName() {
        return $this->_labelName;
    }
}