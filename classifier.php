<?php

class Classifier {
    
    private $_labels = [];

    public function __construct(array $labels) {
        $this->_labels = $labels;
    }

    public function classify($positiveVotes, $reponseTime, $userTime) {
        $class = NULL;
        $localProb = 0;
        $maxProb = 0;
        foreach($this->_labels as $key => $value) {
            $localProb = $value->getProbability($positiveVotes, $reponseTime, $userTime);
            if ( $localProb > $maxProb) {
                $maxProb = $localProb;
                $class = $value ->getLabelName();
            }
        }
        /*
        print("LA CLASIFICACIÓN ARROJÓ EL SIGUIENTE RESULTADO: <br />");
        print("EL USUARIO ES ". strtoupper($class) . " CON UNA CERTEZA DEL ". $maxProb);*/
        return $class;
    }
}