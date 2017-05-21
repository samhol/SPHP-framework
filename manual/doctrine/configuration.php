<?php

namespace Doctrine\ORM;

use Doctrine\ORM\Configuration;
use Sphp\Db\EntityManagerFactory;

$isDevMode = true;

// the connection configuration

$dbParams = \Sphp\Stdlib\Parser::fromFile('manual/config/db.yaml');
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
$driverImpl = $config->newDefaultAnnotationDriver('manual/doctrine/entities');
$config->setMetadataDriverImpl($driverImpl);
$config->setQueryCacheImpl($cache);
$config->setProxyDir('manual/doctrine/Proxies');
$config->setProxyNamespace('Sphp\Doctrine\Proxies');

EntityManagerFactory::setDefaults($dbParams, $config);