<?php

namespace Sphp\DateTime;

var_dump(Intervals::create('+2 days')->toHours());
var_dump(Intervals::create('PT2H')->toMinutes());
var_dump(Intervals::create('0:01:21')->toSeconds());
