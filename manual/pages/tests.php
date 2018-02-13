<?php

namespace Sphp\Manual;
use Sphp\Html\Attributes\JsonAttribute;
$json = new JsonAttribute('json', '{ "foo": "bar" }');
$json['foo1'] = 'bar';
echo $json;
?>
