<?php

namespace Sphp\FileSystem;

use Sphp\Core\Path;

$manualLinks = Parser::fromFile(Path::get()->local('manual/yaml/documentation_links.yaml'));
$dependenciesLinks = Parser::fromFile(Path::get()->local('manual/yaml/dependencies_links.yml'));
$externalApiLinks = Parser::fromFile(Path::get()->local('manual/yaml/apidocs_menu.yml'));
