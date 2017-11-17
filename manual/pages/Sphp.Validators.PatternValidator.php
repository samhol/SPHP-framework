<?php

namespace Sphp\Validators;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$patrnvLink = \Sphp\Manual\api()->classLinker(PatternValidator::class);

\Sphp\Manual\parseDown(<<<MD
##The $patrnvLink class		
  
The $patrnvLink validates the input against the given regular expression. The input
is valid if it matches the given pattern. 
MD
);

CodeExampleBuilder::visualize('Sphp/Validators/PatternValidator.php', 'php', false);
