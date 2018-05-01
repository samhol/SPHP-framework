<?php

namespace Sphp\DateTime\Calendars\Events\Constraints;

$constraints = new Constraints();

$constraints->dateIs(new OneOf('yesterday', 'today', 'tomorrow'));
$constraints->dateIs(new Weekly(5));
$constraints->dateIsNot(new Unique('next friday'));



$begin = new \DateTime('today - 1 week');
$end = new \DateTime('today + 1 week');

$interval = new \DateInterval('P1D');
$daterange = new \DatePeriod($begin, $interval, $end);

foreach ($daterange as $date) {
  echo $date->format('l Y-m-d') . ":\t";
  var_dump($constraints->isValidDate($date->format('Y-m-d')));
}
