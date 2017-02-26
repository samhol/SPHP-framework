<?php

namespace Sphp\Validators;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$validatorInterface = Apis::apigen()->classLinker(ValidatorInterface::class);
$validatorAggregate = Apis::apigen()->classLinker(ValidatorAggregate::class);

echo $parsedown->text(<<<MD
##The $validatorAggregate class		
        
The $validatorAggregate is an aggregation of $validatorInterface objects. It 
validates the given input against all of its inner $validatorInterface validators 
and the input is valid only if it passes all of them.
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Validators/ValidatorAggregate.php", "php", false);
