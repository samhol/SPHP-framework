<?php

namespace Sphp\Config;

error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
require_once(__DIR__ . '/../sphp/settings.php');

$includePaths = [
    __DIR__ . '/examples',
    __DIR__ . '/pages',
    realpath(__DIR__ . '/../'),
    __DIR__,
];

\Sphp\Config\PHP::Config()
        ->setErrorReporting(\E_ALL)
        ->setDefaultTimezone('Europe/Helsinki')
        ->setCharacterEncoding('UTF-8')
        ->insertIncludePaths($includePaths);

require_once 'common/all.php';

namespace Sphp\I18n;

Translators::instance()->store('validation', new Gettext\Translator('Sphp.Validation', 'sphp/locale'));
