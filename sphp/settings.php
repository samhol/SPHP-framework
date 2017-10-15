<?php

/**
 * This file holds the common settings to the PHP project
 */
use Sphp\Config\PHPConfig;

require_once(__DIR__ . '/../vendor/autoload.php');

(new PHPConfig())
        ->insertIncludePaths(__DIR__);
