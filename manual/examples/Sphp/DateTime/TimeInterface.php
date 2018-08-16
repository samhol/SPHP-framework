<?php

namespace Sphp\DateTime;

$now = new DateTime();
var_dump($now->getHours(), $now->getMinutes(), $now->getSeconds(), $now->getTimeZoneName());
