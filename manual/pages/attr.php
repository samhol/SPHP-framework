<?php

namespace Sphp\Html\Attributes;

echo '<pre>';
$p = new MultiValueParser();
$p->setAtomicValidator(new \Sphp\Validators\Regex('/(#[\w]+)/'));
var_dump($p->filter(['#a', '#4', '#_4-4']));
echo '</pre>';

