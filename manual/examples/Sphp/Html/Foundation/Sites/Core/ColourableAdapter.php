<?php

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\Document;

$paragraph = Document::get('button:reset', 'ccperger');
$adapter = new ColourableAdapter($paragraph);
echo $adapter->setColor('alert');
echo $adapter->setColor('warning');
?>