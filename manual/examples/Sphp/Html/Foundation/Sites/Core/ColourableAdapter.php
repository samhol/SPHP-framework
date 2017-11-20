<?php

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\Factory;

$button = Factory::pushButton('Push me!')->addCssClass('button');

$adapter = new ColourableAdapter($button);
echo $adapter->setColor('alert');
echo $adapter->setColor('success');
