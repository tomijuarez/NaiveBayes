<?php

require_once "data/table.php";
require_once "data/triad.php";
require_once "variables/range.php";
require_once "variables/concrete.php";
require_once "labels/label.php";
require_once "classifier.php";
require_once "validator/validation.php";
require "library/Rain/autoload.php";

use Rain\Tpl;

$config = array (
    "tpl_dir"       => "public/templates/",
    "cache_dir"     => "cache/",
    "debug"         => true, // set to false to improve the speed
);

Tpl::configure( $config );

Tpl::registerPlugin(new Tpl\Plugin\PathReplace());

$tpl = new Tpl;

$validation = new Validation();

$validation->setFlags(array(
    'votes'    => 'int', 
    'sales'    => 'int', 
    'response' => 'float', 
    'time'     => 'int'
));

$passed = $validation->validate($_GET);

if (!$passed) {
    // assign a variable
    $tpl->assign(array(
        "title"   => "Oops!",
        "errorTitle" => "Oops!",
        "errorSubTitle" => "un error ha ocurrido :(",
        "errorMsg" => "Cada campo recibido debe ser un número entero excepto el campo tiempo medio de respuesta que puede ser entero o tener un formato del tipo 0.X, es decir, de punto fijo. Asegúrese de completar los datos correctamente."
    ));
    // draw the template
    $tpl->draw("error");
}
else {
    $auxVotes = $_GET["votes"];
    $sales = $_GET["sales"];
    $response = $_GET["response"];
    $time = $_GET["time"];

    if ($sales < $auxVotes) {

        // assign a variable
        $tpl->assign(array(
            "title"   => "Oops!",
            "errorTitle" => "Oops!",
            "errorSubTitle" => "un error ha ocurrido :(",
            "errorMsg" => "No puede ocurrir que haya más votos positivos que ventas."
        ));
        // draw the template
        $tpl->draw("error");
    }
    else {
        $positiveVar = new ConcreteVariable("positive");
        $negativeVar = new ConcreteVariable("negative");

        $responseTime1 = new RangeVariable(0,1);
        $responseTime2 = new RangeVariable(1,5);
        $responseTime3 = new RangeVariable(5);

        $userTime1 = new RangeVariable(0,2);
        $userTime2 = new RangeVariable(2,8);
        $userTime3 = new RangeVariable(8);

        $entry1 = new Triad($positiveVar, $responseTime1, $userTime1);
        $entry2 = new Triad($positiveVar, $responseTime1, $userTime2);
        $entry3 = new Triad($positiveVar, $responseTime1, $userTime3);
        $entry4 = new Triad($positiveVar, $responseTime2, $userTime1);
        $entry5 = new Triad($positiveVar, $responseTime2, $userTime2);
        $entry6 = new Triad($positiveVar, $responseTime2, $userTime3);
        $entry7 = new Triad($positiveVar, $responseTime3, $userTime1);
        $entry8 = new Triad($positiveVar, $responseTime3, $userTime2);
        $entry9 = new Triad($positiveVar, $responseTime3, $userTime3);

        $entry10 = new Triad($negativeVar, $responseTime1, $userTime1);
        $entry11 = new Triad($negativeVar, $responseTime1, $userTime2);
        $entry12 = new Triad($negativeVar, $responseTime1, $userTime3);
        $entry13 = new Triad($negativeVar, $responseTime2, $userTime1);
        $entry14 = new Triad($negativeVar, $responseTime2, $userTime2);
        $entry15 = new Triad($negativeVar, $responseTime2, $userTime3);
        $entry16 = new Triad($negativeVar, $responseTime3, $userTime1);
        $entry17 = new Triad($negativeVar, $responseTime3, $userTime2);
        $entry18 = new Triad($negativeVar, $responseTime3, $userTime3);

        $appallingTable = new Table();
        $appallingTable->addEntry($entry1,   0);
        $appallingTable->addEntry($entry2,   0);
        $appallingTable->addEntry($entry3,   0);
        $appallingTable->addEntry($entry4,   0);
        $appallingTable->addEntry($entry5,   0);
        $appallingTable->addEntry($entry6,   0);
        $appallingTable->addEntry($entry7,   0);
        $appallingTable->addEntry($entry8,   0);
        $appallingTable->addEntry($entry9,   0);
        $appallingTable->addEntry($entry10, .3);
        $appallingTable->addEntry($entry11, .3);
        $appallingTable->addEntry($entry12, .25);
        $appallingTable->addEntry($entry13, .55);
        $appallingTable->addEntry($entry14, .45);
        $appallingTable->addEntry($entry15, .3);
        $appallingTable->addEntry($entry16, .8);
        $appallingTable->addEntry($entry17, .7);
        $appallingTable->addEntry($entry18, .6);

        $badTable = new Table();
        $badTable->addEntry($entry1,  0);
        $badTable->addEntry($entry2,  0);
        $badTable->addEntry($entry3,  0);
        $badTable->addEntry($entry4,  0);
        $badTable->addEntry($entry5,  0);
        $badTable->addEntry($entry6,  0);
        $badTable->addEntry($entry7, .3);
        $badTable->addEntry($entry8, .2);
        $badTable->addEntry($entry9, .1);
        $badTable->addEntry($entry10, .43);
        $badTable->addEntry($entry11, .34);
        $badTable->addEntry($entry12, .29);
        $badTable->addEntry($entry13, .25);
        $badTable->addEntry($entry14, .4);
        $badTable->addEntry($entry15, .5);
        $badTable->addEntry($entry16, .2);
        $badTable->addEntry($entry17, .3);
        $badTable->addEntry($entry18, .4);

        $neutroTable = new Table();
        $neutroTable->addEntry($entry1, .25);
        $neutroTable->addEntry($entry2, .2);
        $neutroTable->addEntry($entry3, .2);
        $neutroTable->addEntry($entry4, .3);
        $neutroTable->addEntry($entry5, .1);
        $neutroTable->addEntry($entry6, .1);
        $neutroTable->addEntry($entry7, .5);
        $neutroTable->addEntry($entry8, .5);
        $neutroTable->addEntry($entry9, .5);
        $neutroTable->addEntry($entry10, .25);
        $neutroTable->addEntry($entry11, .25);
        $neutroTable->addEntry($entry12, .35);
        $neutroTable->addEntry($entry13, .2);
        $neutroTable->addEntry($entry14, .15);
        $neutroTable->addEntry($entry15, .2);
        $neutroTable->addEntry($entry16, 0);
        $neutroTable->addEntry($entry17, 0);
        $neutroTable->addEntry($entry18, 0);

        $goodTable = new Table();
        $goodTable->addEntry($entry1, .4);
        $goodTable->addEntry($entry2, .35);
        $goodTable->addEntry($entry3, .3);
        $goodTable->addEntry($entry4, .5);
        $goodTable->addEntry($entry5, .5);
        $goodTable->addEntry($entry6, .4);
        $goodTable->addEntry($entry7, .1);
        $goodTable->addEntry($entry8, .2);
        $goodTable->addEntry($entry9, .3);
        $goodTable->addEntry($entry10, .01);
        $goodTable->addEntry($entry11, .1);
        $goodTable->addEntry($entry12, .1);
        $goodTable->addEntry($entry13, 0);
        $goodTable->addEntry($entry14, 0);
        $goodTable->addEntry($entry15, 0);
        $goodTable->addEntry($entry16, 0);
        $goodTable->addEntry($entry17, 0);
        $goodTable->addEntry($entry18, 0);

        $excellentTable = new Table();
        $excellentTable->addEntry($entry1, .35);
        $excellentTable->addEntry($entry2, .45);
        $excellentTable->addEntry($entry3, .5);
        $excellentTable->addEntry($entry4, .2);
        $excellentTable->addEntry($entry5, .4);
        $excellentTable->addEntry($entry6, .5);
        $excellentTable->addEntry($entry7, .1);
        $excellentTable->addEntry($entry8, .1);
        $excellentTable->addEntry($entry9, .1);
        $excellentTable->addEntry($entry10, .01);
        $excellentTable->addEntry($entry11, .01);
        $excellentTable->addEntry($entry12, .01);
        $excellentTable->addEntry($entry13, 0);
        $excellentTable->addEntry($entry14, 0);
        $excellentTable->addEntry($entry15, 0);
        $excellentTable->addEntry($entry16, 0);
        $excellentTable->addEntry($entry17, 0);
        $excellentTable->addEntry($entry18, 0);

        $appallingLabel = new Label("pésimo", $appallingTable);
        $badLabel = new Label("malo", $badTable);
        $neutroLabel = new Label("neutro", $neutroTable);
        $goodLabel = new Label("bueno", $goodTable);
        $excellentLabel = new Label("excelente", $excellentTable);

        $naivesBayes = new Classifier(array($appallingLabel, $badLabel, $neutroLabel, $goodLabel, $excellentLabel));


        $votes = ($sales == 0) ? 0 : $auxVotes / $sales;

        $class = $naivesBayes->classify($votes, $response, $time);

        // assign a variable
        $tpl->assign(array(
            "title"         => "Clasificación de usuarios.",
            "successTitle"  => "El usuario ha sido clasificado exitosamente.",
            "votes"         => round($votes * 100, 3),
            "response"      => $response,
            "time"          => $time,
            "class"         => $class,
            "appallingPctg" => round($appallingLabel->getProbability($votes, $response, $time) * 100, 3),
            "badPctg"       => round($badLabel->getProbability($votes, $response, $time) * 100, 3),
            "neutralPctg"   => round($neutroLabel->getProbability($votes, $response, $time) * 100, 3),
            "goodPctg"      => round($goodLabel->getProbability($votes, $response, $time) * 100, 3),
            "excellentPctg" => round($excellentLabel->getProbability($votes, $response, $time) * 100, 3)
        ));
        // draw the template
        $tpl->draw("main");
    }
}