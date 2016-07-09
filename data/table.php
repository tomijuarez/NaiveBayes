<?php

require_once "triad.php";

class Table {
    
    private $_entries;

    public function __construct() {
        $this->_entries = new SplObjectStorage();    
    }

    public function addEntry(Triad $key, $prob) {
        $this->_entries[$key] = $prob;
    }

    public function getProbability($first, $second, $third) {
        return ($first * $this->_getProbability("positive", $second, $third) + 
                (1 - $first) * $this->_getProbability("negative", $second, $third));
    }

    public function _getProbability($first, $second, $third) {
        foreach($this->_entries as $key => $value)
            if ($value->correctEntry($first, $second, $third))
                return $this->_entries[$value];
        return 0;
    }
}