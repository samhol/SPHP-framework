<?php

namespace Sphp\Stdlib\Parsers;

use Sphp\Manual;
use Sphp\Stdlib\Parser;
use Sphp\Html\Foundation\Sites\Buttons\ButtonGroup;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$phpArray = Manual\php()->typeLink('array');
$parser = Manual\api()->classLinker(Parser::class);
Manual\md(<<<MD
#PARSING  <small>reading, writing and transforming</small>
$ns
$parser instance can handle file related (reading and writing) operations.
MD
);
$yaml = Manual\api()->classLinker(Yaml::class);
Manual\md(<<<MD
##YAML <small>data serialization standard</small>
        
[YAML](http://yaml.org/) is a human friendly data serialization standard for all programming languages. 
        
A instance of $yaml class is able to transform YAML files and strings to PHP arrays and PHP arrays back to YAML files and strings.
        
MD
);

Manual\example('Sphp/Stdlib/Parsers/Yaml.php', null, false)->setExamplePaneTitle('Examples of YAML data manipulation')->printHtml();

$yamlCode = Manual\codeModal('<i class="fas fa-cogs"></i> YAML file', 'manual/snippets/example.yml', 'YAML file example');
$yamlCodeButton = $yamlCode->getTrigger()->addCssClass('button', 'alert', 'radius', 'small');
$parsedYaml = Manual\codeModalFromString('<i class="fab fa-php"></i> PHP array', print_r(Parser::fromFile('manual/snippets/example.yml'), true), 'php', 'YAML-file as parsed PHP array');
$tr1 = $parsedYaml->getTrigger()->addCssClass('button', 'php', 'radius', 'small');


$buttonGroup = new ButtonGroup();
$buttonGroup->setSize('small');
$buttonGroup->appendButton($yamlCode->getTrigger());
$buttonGroup->appendButton($parsedYaml->getTrigger());
echo $buttonGroup . $yamlCode->getPopup() . $parsedYaml->getPopup();

Manual\loadPage('Sphp.Stdlib.Parsers.Markdown');
