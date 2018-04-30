<?php

namespace Sphp\DateTime\Calendars\Events\Constraints;

use Sphp\DateTime\Date;

$constraints = new Constraints();

$constraints->append(new Unique(new Date('today')));
$constraints->append(new Weekly(1, 7));

$today = new Date();
var_dump($constraints->isValid($today));
$monday = $today->modify('last Monday');
var_dump($constraints->isValid($monday));
$friday = $today->modify('last Friday');
var_dump($constraints->isValid($friday));
