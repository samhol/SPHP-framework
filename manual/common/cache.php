<?php

namespace Zend\Cache\Storage;

use Zend\Cache\PatternFactory;
use Sphp\Stdlib\Parsers\ParseFactory;

$cache = new Adapter\Filesystem();

$cache->setOptions(ParseFactory::yaml()->fileToArray('manual/config/cache.yml'));

$plugin = new Plugin\ExceptionHandler(['throw_exceptions' => true]);
$cache->addPlugin($plugin);
$outputCache = PatternFactory::factory('output', [
            'storage' => $cache
        ]);
