<?php

namespace Sphp\Html\Attributes;

echo "<pre>";
$mngr = new AbstractAttributeManager([
    'class' => MultiValueAttribute::class,
    'style' => PropertyAttribute::class,
    'data-foo' => PropertyAttribute::class]);
var_dump($mngr->exists('class'), $mngr->exists('foo'));
//$objMap->mapObject('data-foo', PropertyAttribute::class);
$mngr->getObject('class')->lock('foo bar');
$mngr->getObject('style')->set('foo:bar;');
var_dump($mngr->exists('class'), $mngr->exists('foo'), "$mngr");
//$objMap->mapObject('data-foo', 'foo');
$mngr->set('blaa', 'blaah');
$mngr->lock('data-foo', 'shit: happens');
$mngr->set('class', range('a', 'e'));
//$mngr->identify('foo');
var_dump("$mngr");
//$mngr->remove('data-foo');
var_dump("$mngr");
$arr = [];
unset($arr[2]);
?>
</pre>
