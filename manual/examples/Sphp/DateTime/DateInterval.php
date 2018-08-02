<?php

namespace Sphp\DateTime;

$interval = new Interval('PT2H');

var_dump(
        $interval->toHours(),
        $interval->toMinutes(), 
        $interval->toSeconds()); 

var_dump(Factory::dateInterval('+2 days')->toSeconds());
