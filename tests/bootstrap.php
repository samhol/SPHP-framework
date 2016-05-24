<?php

error_reporting(E_ALL);
echo __DIR__.'/../vendor/autoload.php';
var_dump( realpath(__DIR__.'/../vendor/autoload.php'));
include_once realpath(__DIR__.'/../sphp/settings.php');
require_once realpath(__DIR__.'/../vendor/autoload.php');
//echo "\n".Sphp\SPH_DIR."\n";
?>
