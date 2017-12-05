<?php

namespace Doctrine\ORM;

use Doctrine\ORM\Configuration;
use Sphp\Database\Doctrine\EntityManagerFactory;

$isDevMode = true;

// the connection configuration
$dbParams = array(
    'driver' => 'pdo_mysql',
    'user' => 'root',
    'password' => '',
    'host' => '127.0.0.1;port=3306',
    'charset' => 'utf8',
    'dbname' => 'sphp',
    'driverOptions' => [1002 => 'SET NAMES utf8']
);

$applicationMode = 'development';
if ($applicationMode == 'development') {
  $cache = new \Doctrine\Common\Cache\ArrayCache;
} else {
  $cache = new \Doctrine\Common\Cache\ApcCache;
}

$config = new Configuration;
//$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$config->setMetadataCacheImpl($cache);
$driverImpl = $config->newDefaultAnnotationDriver('sphp/doctrine/entities');
$config->setMetadataDriverImpl($driverImpl);
$config->setQueryCacheImpl($cache);
$config->setProxyDir('sphp/doctrine/Proxies');
$config->setProxyNamespace('Sphp\Doctrine\Proxies');

EntityManagerFactory::setDefaults($dbParams, $config);
