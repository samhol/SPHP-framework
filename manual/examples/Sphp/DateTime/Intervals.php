<?php

namespace Sphp\DateTime;

var_dump(Intervals::create('+2 days')->toDays());
var_dump(Intervals::create('PT2H')->toHours());
var_dump(Intervals::create('0:01:21')->toSeconds());
var_dump(Intervals::create(-62)->toMinutes());

$interval = Intervals::create(-112412e9);
var_dump(Intervals::toString($interval));
