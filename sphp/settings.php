<?php

/**
 * This file holds the common settings to the PHP project
 */
use Sphp\Config\PHP;

require_once(__DIR__ . '/../vendor/autoload.php');

PHP::config()
        ->insertIncludePaths(__DIR__);

