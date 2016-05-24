<?php

// bootstrap.php

namespace Sphp;

header("Content-type: text/html; charset=utf-8");
require_once "manual/settings.php";

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;

$paths = array("/sphp/entity-files");
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
$applicationMode = "development";
if ($applicationMode == "development") {
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
$entityManager = EntityManager::create($dbParams, $config);

use Sphp\Db\Objects\User as User;

//$article = $entityManager->find(User::class, 1);
//$johndoe = $entityManager->find(User::class, 2);
//var_dump($entityManager->contains($article));
echo "<pre>";
//print_r($article->toArray());
//print_r($johndoe->toArray());

//$query = $entityManager->createQuery('SELECT u FROM ' . User::class . ' u');
//$users = $query->getResult();


$userTable = new Db\Objects\Users($entityManager);
$u3 = $userTable->get(1262);
var_dump($u3->toArray());
print_r($userTable->findByUsername("samhol")->toArray());
//echo "Pekka Puupää";

$pekka = new User([
    "username" => "jukka",
    "fname" => "Jukka",
    "lname" => "Puupää",
    "street" => "Puupäätie 59 A 3",
    "zipcode" => "20720",
    "city" => "Turku",
    "country" => "Finland"
        ]);
print_r($pekka->getAddress());
$entityManager->persist($pekka->getAddress());
$entityManager->flush();
//$userTable->insert($pekka);
