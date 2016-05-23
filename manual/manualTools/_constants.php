<?php

namespace Sphp\Core;


//use Sphp\Tools\Config as Config;
//define("APIGEN", HTTP_ROOT . "API/php/apigen/");
//define("PHPDOC", HTTP_ROOT . "API/php/phpdoc/");
//Config::instance()->set("manual.examples", realpath(__DIR__ . "/../examples") ."/");
$examples = realpath(__DIR__ . "/../examples");
$pages = realpath(__DIR__ . "/../pages");
$tools = realpath(__DIR__ . "/../manualTools");
define("EXAMPLE_DIR", $examples . "/");
define("Sphp\Manual\EXAMPLE_FOLDER", $examples);
define("Sphp\Manual\PAGE_FOLDER", $pages);
//define("Sphp\Manual\LOREM_IPSUM_PATH", $examples . "/loremIpsum.txt");
//define("EXAMPLE_HTTP_PATH", HTTP_ROOT . "sphManualFiles/examples/");
//define("LOREM_IPSUM_AJAX", Config::getVar("HTTP_ROOT") . "sphpManual/examples/loremIpsum.txt");
//define("manual\LOREM_IPSUM_PATH", $examples . "/loremIpsum.txt");
//define("manual\LOREM_IPSUM_HTTP", \Sphp\HTTP_ROOT . "sphpManual/examples/loremIpsum.txt");
//define("manual\CSV_PATH", $examples . "/example.csv");
//$appConf = Config::instance();
//$appConf["EXAMPLE_DIR"] = realpath(__DIR__ . "/../examples") . "/";
//$appConf["MANUAL_ROOT"] = realpath(__DIR__ . "/../") . "/";
//namespace Sphp\manual;
//const APIGEN = "http://apigen.samiholck.com/";
//const PHPDOC = "http://phpdoc.samiholck.com/";
