<?php

namespace Sphp\Config;

use Sphp\Stdlib\Networks\URL;

Config::instance('manual')->set('CURRENT_URL', URL::getCurrentURL());
Config::instance('manual')->set('ROOT_URL', 'http://playground.samiholck.com/');
$svg = \Sphp\Html\Media\Icons\SvgLoader::instance();
$svg->setFlagPath('http://data.samiholck.com/svg/flags/');