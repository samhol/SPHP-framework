<?php

namespace Sphp\Core;

Configuration::useDomain('manual')
		->set('jsdoc', 'http://documentation.samiholck.com/jsdoc/')
		->set('apigen', 'http://documentation.samiholck.com/apigen/');

Config\Config::instance();