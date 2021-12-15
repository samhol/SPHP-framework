<?php
 
use Sphp\Apps\Linking\PHP\BasicPhpApiLinker;

$api = new BasicPhpApiLinker();
$api->mapApigen('Symfony\\Component\\Yaml', 'http://apigen.juzna.cz/doc/symfony/symfony/');
$api->getHyperlinkFactory()->setDefaults(['target' => 'symfony-api']);
$api->mapSami('Sphp', '/API/sami/');