<?php

namespace Sphp\Html\Attributes;
$pattr = new PropertyCollectionAttribute('style');
$pattr->setProperty('border', 'solid #aaa 1px');
$pattr['width'] = '2rem';
echo $pattr;
$pattr->protect('foo:bar');
echo $pattr;
