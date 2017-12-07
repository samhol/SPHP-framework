<?php

namespace Sphp\Html\Foundation\Sites\Containers;

$modal = new Modal('locations', "<h3>MySQL version of locations table</h3>".(new \Sphp\Html\Apps\Syntaxhighlighting\SyntaxHighlighter())->loadFromFile('Sphp/Database/locations.sql'));

echo $modal->setSize('large');
