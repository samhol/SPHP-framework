<?php

namespace Sphp\DateTime;

$dateRange = Period::from('2018-01-01 12:30:22 EET', '2018-02-05 12:30:22 EET');
var_dump(
        $dateRange->isInRange('2018-01-01'), 
        $dateRange->isInRange('2018-01-05'), 
        $dateRange->isInRange('2018-01-03'), 
        $dateRange->isInRange('2017-12-31'), 
        $dateRange->isInRange('2018-01-6'));
