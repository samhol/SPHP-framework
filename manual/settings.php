<?php

namespace Sphp\Config;

require_once(__DIR__ . '/../sphp/settings.php');

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

require_once('_errorHandling.php');

//require_once('doctrine/configuration.php');
//require_once('session.php');
require_once('menuArrays.php');

namespace Sphp\I18n;

Translators::instance()->store('validation', new Gettext\Translator('Sphp.Validation'));
