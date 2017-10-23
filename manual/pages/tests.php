<?php
namespace Sphp\Html\Attributes;

$s = AttributeGenerator::instance();
echo "<pre>";
var_dump($s->getClassAttribute('class')->add('foo'));
var_dump($s->createAttribute('class')->add('foo'));
var_dump(AttributeGenerator::instance()->getClassAttribute('class')->add('foo'));
var_dump($s->getClassAttribute('class')->add('foo'));
var_dump($s->createAttribute('style')->set('foo:bar'));
var_dump($s->createAttribute('style'));
var_dump(AttributeGenerator::instance()->createAttribute('style'));
var_dump($s->createAttribute('style'));
var_dump($s->createAttribute('data-foo'));
var_dump($s->createAttribute('data-foo1'));
var_dump($s->createAttribute('data-foo1'));
