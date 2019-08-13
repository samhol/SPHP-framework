<?php

namespace Doctrine\ORM;

use Doctrine\ORM\Configuration;
use Sphp\Database\Doctrine\EntityManagerFactory;
use Sphp\Stdlib\Parsers\ParseFactory;

$isDevMode = true;

// the connection configuration

$dbParams = ParseFactory::fromFile('manual/config/db.yaml');
//echo '<pre>';
//var_dump($dbParams);
//echo '</pre>';
$applicationMode = 'development';
if ($applicationMode == 'development') {
  $cache = new \Doctrine\Common\Cache\ArrayCache;
} else {
  $cache = new \Doctrine\Common\Cache\ApcCache;
}

$config = new Configuration;
//$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$config->setMetadataCacheImpl($cache);
$driverImpl = $config->newDefaultAnnotationDriver(__DIR__ . '/Entities');
$config->setMetadataDriverImpl($driverImpl);
$config->setQueryCacheImpl($cache);
$config->setProxyDir(__DIR__ . '/Proxies');
$config->setProxyNamespace('Sphp\Doctrine\Proxies');

EntityManagerFactory::setDefaults($dbParams, $config);
