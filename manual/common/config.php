<?php

namespace Sphp\Config;

use Sphp\Stdlib\Networks\URL;

Config::instance('manual')->set('CURRENT_URL', URL::getCurrentURL());
