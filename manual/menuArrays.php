<?php

namespace Sphp\Stdlib;

use Sphp\Stdlib\Path;

$manualLinks = Parser::fromFile(Path::get()->local('manual/yaml/documentation_links.yaml'));
$dependenciesLinks = Parser::fromFile(Path::get()->local('manual/yaml/dependencies_links.yml'));
$externalApiLinks = Parser::fromFile(Path::get()->local('manual/yaml/apidocs_menu.yml'));