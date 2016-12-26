<?php

namespace Sphp\Core\Config;

echo "Current Configurator domain is: '" . Configuration::current()->getDomainName() . "'\n";
Configuration::useDomain("foo")
        ->set("text", "foo")
        ->phpConfiguration()
          ->setEncoding("UTF-8")
          ->setErrorReporting(E_ALL)
          ->setDefaultTimezone("Europe/Helsinki");

echo "Current Configurator domain is: '" . Configuration::current()->getDomainName() . "'\n";
echo "timezone is: " . date_default_timezone_get() . "\n";
echo "text: " . Configuration::current()->get("text") . "\n";

$barConf = Configuration::useDomain("bar")
        ->set("text", "bar");
$barConf->phpConfiguration()
        ->setErrorReporting(0)
          ->setDefaultTimezone("Europe/London");

echo "Current Configurator domain is: '" . Configuration::current()->getDomainName() . "'\n";
echo "timezone is: " . date_default_timezone_get() . "\n";
echo "text: " . Configuration::current()->get("text") . "\n";
Configuration::useDomain("foo")
        ->phpConfiguration()
          ->init();
echo "Current Configurator domain is: '" . Configuration::current()->getDomainName() . "'\n";
echo "timezone is: " . date_default_timezone_get() . "\n";
Configuration::useDomain("manual");
echo "Current Configurator domain is: '" . Configuration::current()->getDomainName() . "'\n";
?>
