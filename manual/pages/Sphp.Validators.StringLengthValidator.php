<?php

namespace Sphp\Validators;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$strLenValLink = Apis::apigen()->classLinker(StringLengthValidator::class);

echo $parsedown->text(<<<MD
###The $strLenValLink class	
        
The $strLenValLink simply validates the input length. This validator supports three 
types of validation
        
 1. Lower bound validation: the length of the input must be above a given limit. 
 2. Upper bound validation: the length of the input must be below a given limit.
 3. Range validation: the length of the input must be between the lower and upper limits. 
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Validators/StringLengthValidator.php", "php", false);
