<?php

namespace Sphp\Config;

session_start();
require_once(__DIR__ . '/../sphp/settings.php');

$includePaths = [
    __DIR__ . '/examples',
    __DIR__ . '/pages',
    realpath(__DIR__ . '/../'),
    __DIR__,
];
PHP::Config()
        ->setErrorReporting(\E_ALL)
        ->setDefaultTimezone('Europe/Helsinki')
        ->setCharacterEncoding('UTF-8')
        ->insertIncludePaths($includePaths);

require_once('_errorHandling.php');

//require_once('doctrine/configuration.php');
//require_once('session.php');
require_once('menuArrays.php');

namespace Sphp\I18n;

Translators::instance()->store('validation', new Gettext\Translator('Sphp.Validation', 'sphp/locale'));
