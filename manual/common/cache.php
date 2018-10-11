<?php

namespace Zend\Cache\Storage;

use Zend\Cache\PatternFactory;
use Sphp\Stdlib\Parsers\Parser;
$cache = new Adapter\Filesystem();

$cache->setOptions(Parser::yaml()->readFromFile('manual/config/cache.yml'));

$plugin = new Plugin\ExceptionHandler(['throw_exceptions' => true]);
$cache->addPlugin($plugin);
$outputCache = PatternFactory::factory('output', [
            'storage' => $cache
        ]);
