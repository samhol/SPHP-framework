<?php

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\Tags;

$button = Tags::pushButton('Push me!')->addCssClass('button');

$adapter = new ColourableAdapter($button);
echo $adapter->setColor('alert');
echo $adapter->setColor('success');
