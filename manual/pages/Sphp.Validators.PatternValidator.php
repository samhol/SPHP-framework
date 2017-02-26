<?php

namespace Sphp\Validators;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$patrnvLink = Apis::apigen()->classLinker(PatternValidator::class);

echo $parsedown->text(<<<MD
##The $patrnvLink class		
  
The $patrnvLink validates the input against the given regular expression. The input
is valid if it matches the given pattern. 
MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Validators/PatternValidator.php", "php", false);
