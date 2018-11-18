<?php

namespace Doctrine\ORM;

use Doctrine\ORM\Configuration;
use Sphp\Database\Doctrine\EntityManagerFactory;
use Sphp\Stdlib\Parsers\Parser;

$isDevMode = true;

// the connection configuration

$dbParams = Parser::fromFile('./manual/config/calendar-db.yml');
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
$config->setProxyDir('./manual/DB/Proxies');
$config->setProxyNamespace('Sphp\Doctrine\Proxies');

EntityManagerFactory::setDefaults($dbParams, $config);


namespace Sphp\Database;

use Sphp\Database\Db;
use PDO;
$year = 2018;
$db1 = new PDO('mysql:host=Localhost;dbname=int48291_workouts;charset=utf8mb4', 'int48291_player', '^E1tT{bEs&}-', array(PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
Db::createFrom($db1, 'workouts');
include 'diaries.php';
foreach ($exercises as $excercise) {
  $date = $excercise->getDate();
  foreach ($excercise as $workout) {
    if ($workout instanceof \Sphp\DateTime\Calendars\Diaries\Sports\WeightLiftingExercise) {
      //var_dump($workout->totalsToString());
      //print_r($workout->toArray());
  echo "\nRows inserted: " . Db::insert('workouts')
          ->into('workout')
          ->columnNames('date', 'name', 'category')
          ->values($date->format('Y-m-d'), $workout->getName(), $workout->getDescription())
          ->affectRows() . "\n";
    }
  }
}
