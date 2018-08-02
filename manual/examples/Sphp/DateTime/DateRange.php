<?php

namespace Sphp\DateTime;

$period = Period::days('2018-01-01 12:30:22 EET', 10);
/*
var_dump(
        $period->isInPeriod('2018-01-01'), //no
        $period->isInPeriod('2018-01-05'), $period->isInPeriod('2018-01-03'), $period->isInPeriod('2017-12-31'), //no
        $period->contains('2018-01-03 12:30:22 EET'), $period->contains('2018-01-03 12:30:22 CET'));  //no

*/
