<?php

namespace Sphp\Core;

//error_reporting(E_ALL);
//ini_set("display_errors", "1");
//date_default_timezone_set("Europe/Helsinki");
//mb_internal_encoding("UTF-8");

require_once(__DIR__ . "/../sphp/settings.php");
//require_once 'doctrineConfiguration.php';

Configuration::useDomain("manual")
        ->phpConfiguration()
        ->setErrorReporting(E_ALL)
        ->iniSet("display_errors", "1")
        ->setDefaultTimezone("Europe/Helsinki")
        ->setEncoding("UTF-8");
//PHPConfiguration();
//ErrorExceptionThrower::start();

Configuration::current()->paths()->requireOnce('manual/doctrineConfiguration.php');
/**
 * Initializes default exceptionhandling mechanism
 */
// Create the ExceptionHandler

namespace Sphp\Core\ErrorHandling;

$handler = new ExceptionHandler();
// Attach an Exception Logger
$handler->attach(new ExceptionLogger(__DIR__ . "/logs/exception_log.log"));
$handler->attach(new ExceptionPrinter());
// Set ExceptionHandler::handle() as the default Exception handler
set_exception_handler(array($handler, 'handle'));

include_once("appConfig.php");
