<?php

use Sphp\Stdlib\Parsers\Parser;
echo '<pre>';
$manualLinks = Parser::yaml()->readFromFile('/home/int48291/public_html/playground/manual/yaml/documentation_links.yaml');
print_r($manualLinks);


echo '</pre>';