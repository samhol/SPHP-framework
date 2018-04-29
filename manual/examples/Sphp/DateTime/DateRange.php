<?php

namespace Sphp\DateTime;

$dateRange = new DateRange(Date::from('2018-01-01'), Date::from('2018-01-05'));
var_dump($dateRange->isInRange('2018-01-01'));
var_dump($dateRange->isInRange('2018-01-05'));
var_dump($dateRange->isInRange('2018-01-03'));
var_dump($dateRange->isInRange('2017-12-31'));
var_dump($dateRange->isInRange('2018-01-6'));
