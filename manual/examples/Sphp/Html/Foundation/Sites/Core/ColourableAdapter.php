<?php

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\Document;

$button = Document::get('button:reset');
$button->setContent('foo');
$adapter = new ColourableAdapter($button);
echo $adapter->setColor('alert');
echo $adapter->setColor('warning');
