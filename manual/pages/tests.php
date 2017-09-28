<?php

namespace Sphp\Html\Attributes;

echo "<pre>";
$objMap = new AttributeObjectManager([
    'class' => MultiValueAttribute::class, 
    'style' => PropertyAttribute::class, 
    'data-foo' => PropertyAttribute::class]);
var_dump($objMap->isMapped('class'), $objMap->isMapped('foo'));
//$objMap->mapObject('data-foo', PropertyAttribute::class);
$objMap->getObject('data-foo')->set('foo:bar;');
var_dump($objMap->isMapped('class'), $objMap->isMapped('foo'), $objMap->__toString());
//$objMap->mapObject('data-foo', 'foo');
$mngr = new HtmlAttributeManager($objMap);
$mngr->set('blaa', 'blaah');
$mngr->lock('data-foo', 'shit: happens');
$mngr->set('class', range('a', 'e'));
var_dump("$mngr");
//$mngr->remove('data-foo');
var_dump("$mngr");
?>
</pre>
