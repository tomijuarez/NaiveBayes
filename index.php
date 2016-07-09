<?php
require "library/Rain/autoload.php";

use Rain\Tpl;

$config = array(
    "tpl_dir"       => "public/templates/",
    "cache_dir"     => "cache/",
    "debug"         => true, // set to false to improve the speed
);

Tpl::configure( $config );

// Add PathReplace plugin (necessary to load the CSS with path replace)
Tpl::registerPlugin( new Tpl\Plugin\PathReplace() );


// create the Tpl object
$tpl = new Tpl;

// assign a variable
$tpl->assign(array(
    "title"   => "Configuración de la red bayesiana"
));
// draw the template
$tpl->draw("config");