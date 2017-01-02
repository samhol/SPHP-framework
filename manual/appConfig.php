<?php

namespace Sphp\Core;

Configuration::useDomain('manual')
		//->set("SPH_DIR", __DIR__)
		//->set("PHP_PACKAGES", __DIR__ . "/packages")
		//->set("LOCALE_PATH", __DIR__ . "/locale")
		//->set("SPH_JS_ROOT_PATH", "sphp/js/")
		//->set("SPH_JS_VENDOR_PATH", "sphp/js/vendor/")
		//->set("SPH_JS_SPH_ALL_PATH", "sphp/js/sph.all.js")
		//->set('SNIPPETS_DIR', realpath(__DIR__ . "/snippets") . "/")
		//->set('HTTP_ROOT', 'http://playground.samiholck.com/')
		->set('jsdoc', 'http://documentation.samiholck.com/jsdoc/')
		->set('apigen', 'http://documentation.samiholck.com/apigen/');

$conf = [
    
];
Config\Config::instance();