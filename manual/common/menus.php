<?php

namespace Sphp\Stdlib\Parsers;

$manualLinks = Parser::yaml()->arrayFromFile('manual/yaml/documentation_links.yaml');
$dependenciesLinks = Parser::yaml()->arrayFromFile('manual/yaml/dependencies_links.yml');
$externalApiLinks = Parser::yaml()->arrayFromFile('manual/yaml/apidocs_menu.yml');


