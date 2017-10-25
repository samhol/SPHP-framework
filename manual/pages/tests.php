<?php

namespace Sphp\Html\Attributes;

echo "<pre>";
echo "multi:\n------\n";
$multi = new MultiValueAttribute('title');
$uniq = new AtomicMultiValueAttribute('coords');
$multi->set(1, 'a', 2, 3, new \stdClass());
$multi->add('foo');
$multi->add('" bar="');
var_dump($multi->isDemanded());
$multi->lock('lock');
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
$boolAttr->set('foo');
echo "\nattr: $boolAttr";
$boolAttr->set('foo');
echo "\nattr: $boolAttr";
var_dump(get_html_translation_table());

namespace Sphp\Html\Attributes\Utils;

$u = Factory::instance();
$u->setUtility(new ClassAttributeUtils());
$u->setUtility(new MultiValueAttributeUtils());
var_dump($u);
var_dump($u->getUtil(ClassAttributeUtils::class));



echo "</pre>";



