<?php

namespace Doctrine\ORM;

//header("Content-type: text/html; charset=utf-8");
require_once 'settings.php';

//use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;
use Sphp\Core\Configuration as Conf;
//$paths = array("/sphp/entity-files");
$isDevMode = true;

// the connection configuration
$dbParams = array(
    'driver' => 'pdo_mysql',
    'user' => 'sphp_framework',
    'password' => 'Vxr79s?8',
    'host' => '192.168.10.208;port=3306',
    'charset' => 'utf8',
    'dbname' => 'sphp',
    'driverOptions' => array(1002 => 'SET NAMES utf8')
);
Conf::useDomain('manual')->set('dbParams', $dbParams);
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

Conf::useDomain('manual')->set(Configuration::class, $config);
$entityManager = EntityManager::create($dbParams, $config);
//use Sphp\Core\Configuration;
//use Doctrine\ORM\EntityManagerInterface as EntityManagerInterface;

Conf::useDomain('manual')->set(EntityManagerInterface::class, $entityManager);
