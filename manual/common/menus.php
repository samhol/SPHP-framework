<?php

namespace Sphp\Stdlib\Parsers;

$manualLinks = Parser::yaml()->readFromFile('manual/yaml/documentation_links.yaml');
$dependenciesLinks = Parser::yaml()->readFromFile('manual/yaml/dependencies_links.yml');
$externalApiLinks = Parser::yaml()->readFromFile('manual/yaml/apidocs_menu.yml');


