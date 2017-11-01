<?php

namespace Sphp\Html\Attributes;

use Sphp\Html\Foundation\Sites\Containers\ThrowableCallout;

$gen = new AttributeGenerator();
$gen->mapType('class', ClassAttribute::class);
$gen->mapType('blaa', PatternAttribute::class, '/^foobar*$/');
try {
  $gen->mapType('class', Attribute::class);
} catch (\Exception $ex) {
  echo new ThrowableCallout($ex);
}
echo "<pre>";
$fooAttr = $gen->createObject('blaa');
$fooAttr->set('foobar');
echo $fooAttr . "\n";
$regexp = new PatternAttribute('regexp', '/^[abc]*$/');
$int = new IntegerAttribute('int');
$intWithMin = new IntegerAttribute('int', -1);
try {
  //$regexp->set('Abc');
  $int->set('foo');
} catch (\Exception $ex) {
  echo new ThrowableCallout($ex);
}
echo $regexp->set('abccbaacabc') . "\n";
echo $int->set('1') . "\n";
echo $intWithMin->set('-1') . "\n";
echo "\nmulti:\n------\n";
$multi = new MultiValueAttribute('title');
$uniq = new UniqueMultiValueAttribute('coords');
$multi->set(1, 'a', 2, 3, new \stdClass());
$multi->add('foo');
$multi->add('" bar="');
var_dump($multi->isDemanded());
$multi->protect('lock');
var_dump($multi->isDemanded());
echo "\n<span $multi> $multi </span>";
$multi->clear();

$multi->add("' bar='");
echo "\n<span $multi> $multi </span>";

echo "\n\nboolean:\n------\n";
$boolAttr = new BooleanAttribute('data-bool', 'true');

echo "\nattr: $boolAttr";
$boolAttr->set('0');
echo "\nattr: $boolAttr";
$boolAttr->set('YES');
echo "\nattr: $boolAttr";
$boolAttr->set('on');
echo "\nattr: $boolAttr";

namespace Sphp\Html\Attributes\Utils;

$u = Factory::instance();
$u->setUtility(new ClassAttributeUtils());
$u->setUtility(new MultiValueAttributeUtils());
var_dump($u);
var_dump($u->getUtil(ClassAttributeUtils::class));



echo "</pre>";
























