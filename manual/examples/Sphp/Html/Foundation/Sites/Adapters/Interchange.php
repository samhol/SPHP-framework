<?php

namespace Sphp\Html\Foundation\Sites\Adapters;

$component = new \Sphp\Html\Div();
$changer = new Interchange($component);
$changer->setQuery('small', 'manual/snippets/loremipsum.html');
$changer->setQuery('medium', 'manual/snippets/Foundation.html');
$changer->setQuery('large', 'manual/snippets/loremipsum.html');
$changer->setQuery('xlarge', 'manual/snippets/Foundation.html');

echo $changer;