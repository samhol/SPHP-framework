# Zend Framework

Zend Framework is a collection of professional PHP packages. It can be used to 
develop web applications and services using PHP 5.6+, and provides 100% 
object-oriented code using a broad spectrum of language features.

## Used Zend packages

<?php

use Sphp\Manual\MVC\Intro\PackageLinkListBuilder;
use Sphp\Stdlib\Arrays;
use Sphp\Stdlib\Parsers\ParseFactory;

$all = ParseFactory::fromFile('./composer.json');
$zends = Arrays::findKeysLike($all['require'], 'zendframework');

echo PackageLinkListBuilder::github()
        ->build(Arrays::findKeysLike($all['require'], 'zendframework'));
