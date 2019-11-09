<?php

namespace Sphp\Stdlib\Parsers;
 
$manualLinks = ParseFactory::yaml()->fileToArray('./manual/yaml/documentation_links.yaml');
//$dependenciesLinks = ParseFactory::yaml()->fileToArray('/home/int48291/public_html/playground/manual/yaml/dependencies_links.yml');
$externalApiLinks = ParseFactory::yaml()->fileToArray('./manual/yaml/apidocs_menu.yml');
