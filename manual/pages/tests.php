<?php

namespace Sphp\Html\Apps\Syntaxhighlighting;

$modal = new SyntaxHighlightingModalBuilders('locations', "<h3>MySQL version of locations table</h3>");
$modal->loadFromFile('Sphp/Database/locations.sql');
echo $modal->buildModal()->setSize('large');
