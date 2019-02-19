<?php

namespace Sphp\Stdlib\Parsers;

$manualLinks = Parser::yaml()->readFromFile('/home/int48291/public_html/playground/manual/yaml/documentation_links.yaml');
$dependenciesLinks = Parser::yaml()->readFromFile('/home/int48291/public_html/playground/manual/yaml/dependencies_links.yml');
$externalApiLinks = Parser::yaml()->readFromFile('/home/int48291/public_html/playground/manual/yaml/apidocs_menu.yml');
