<?php

namespace Sphp\Config;

require_once(__DIR__ . '/../sphp/settings.php');
require_once('_errorHandling.php');

$includePaths = [
    realpath(__DIR__ . '/../'),
    __DIR__,
    __DIR__ . '/examples',
    __DIR__ . '/pages'
];
(new PHPConfig())
        ->setErrorReporting(E_ALL)
        ->setDefaultTimezone('Europe/Helsinki')
        ->setEncoding('UTF-8')
        ->setIncludePaths($includePaths)
        ->init();
//require_once('doctrine/configuration.php');
//require_once('session.php');
require_once('menuArrays.php');
