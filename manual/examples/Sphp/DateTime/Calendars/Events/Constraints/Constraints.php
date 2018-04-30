<?php

namespace Sphp\DateTime\Calendars\Events\Constraints;

use Sphp\DateTime\Date;

$constraints = new Constraints();

$constraints->append(new Unique('today'));
$constraints->append(new Weekly(1, 7));

$today = new Date();
var_dump($constraints->isValidDate($today));
$monday = $today->modify('last Monday');
var_dump($constraints->isValidDate($monday));
$friday = $today->modify('last Friday');
var_dump($constraints->isValidDate($friday));
