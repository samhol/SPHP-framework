<?php

namespace Sphp\Validators;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$validatorInterface = Apis::apigen()->classLinker(ValidatorInterface::class);

$inputValidator = $api->classLinker(OptionalValidator::class);

$formValidator = Apis::apigen()->classLinker(FormValidator::class);
$formInterface = Apis::apigen()->classLinker(\Sphp\Html\Forms\FormInterface::class);
$traversable = Apis::phpManual()->classLinker(\Traversable::class);
$arrayaccess = Apis::phpManual()->classLinker(\ArrayAccess::class);
$array = $php->typeLink("array", "arrays");
echo $parsedown->text(
        <<<MD
##The $formValidator validator		
A $formValidator is an aggregate of validators validating user inputs data provided 
by HTML forms like the ones implementing $formInterface. A $formValidator can validate 
PHP's native $array and just about any kind of $traversable data containing key value pairs.	
        
$formValidator supports two ways of manipulating validators for named input data values.		
  
 1. By using PHP's array notation provided by the $arrayaccess interface 
    * **IMPORTANT!** the offset key points to the corresponding offset in the data that is to be validated
 2. By using chainable object oriented methods 
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Validators/FormValidator.php", "php", false);
