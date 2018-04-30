<?php

namespace Sphp\DateTime\Calendars\Events\Constraints;

$constraints = new Constraints();

$constraints->dateIs(new Unique('today'));
$constraints->dateIs(new Weekly(1, 3, 7));
$constraints->dateIsNot(new Unique('last sunday'));



$begin = new \DateTime('today - 1 week');
$end = new \DateTime('today + 1 week');

$interval = new \DateInterval('P1D');
$daterange = new \DatePeriod($begin, $interval, $end);

foreach ($daterange as $date) {
  echo $date->format('l Y-m-d') . ":\t";
  var_dump($constraints->isValidDate($date->format('Y-m-d')));
}
