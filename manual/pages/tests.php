<?php
namespace Sphp\Html\Attributes;

$s = AttributeGenerator::instance();
echo "<pre>";
//$s->mapObject('data-foo', PropertyAttribute::class);
var_dump($s->createAttribute('class', ClassAttribute::class)->set('foo'));
var_dump($s->getClassAttribute('class', ClassAttribute::class)->add('foo'));
var_dump($s->createAttribute('style', PropertyAttribute::class)->set('foo:bar'));
var_dump($s->createAttribute('style', PropertyAttribute::class));
var_dump($s->createAttribute('style', PropertyAttribute::class));
var_dump($s->createAttribute('data-foo', ClassAttribute::class));
var_dump($s->createAttribute('data-foo1', ClassAttribute::class));

var_dump($s);
$class = new \ReflectionClass(AttributeGenerator::class);
$arr = $class->getStaticProperties();

var_dump($arr);
