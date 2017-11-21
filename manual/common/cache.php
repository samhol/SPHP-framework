<?php

namespace Zend\Cache\Storage;

use Zend\Cache\PatternFactory;

$cache = new Adapter\Filesystem();

$cache->setOptions([
    'ttl' => 1,
    'cache_dir' => '/home/int48291/public_html/playground/cache',
    'dir_permission' => 0755,
    'file_permission' => 0666]);


$plugin = new Plugin\ExceptionHandler(['throw_exceptions' => true]);
$cache->addPlugin($plugin);
$outputCache = PatternFactory::factory('output', [
            'storage' => $cache
        ]);
