<?php

namespace Sphp\Html\Apps\Syntaxhighlighting;

$modal = new SyntaxHighlightingModalBuilder((new \Sphp\Html\Span('locations'))->addCssClass('button'), "`MySQL` version of locations table");
$modal->loadFromFile('Sphp/Database/locations.sql');

echo $modal->buildModal()->setSize('large');
