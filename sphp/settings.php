<?php

/**
 * This file holds the common settings to the PHP project
 */
use Sphp\Config\PHPConfig;
require_once('vendor/autoload.php');

(new PHPConfig())
        ->setIncludePaths(__DIR__)
        ->init();
