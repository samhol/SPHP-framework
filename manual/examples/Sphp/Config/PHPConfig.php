<?php

namespace Sphp\Config;

PHP::Config()->setDefaultTimezone("Pacific/Honolulu");
echo "Current time in Honolulu Hawaii:\t" . date('H:i:s T') . "\n";

PHP::Config()->setDefaultTimezone("Europe/Helsinki");
echo "Current time in Helsinki Finland:\t" . date('H:i:s T');
