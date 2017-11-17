<?php

namespace Sphp\Validators;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$validatorInterface = \Sphp\Manual\api()->classLinker(ValidatorInterface::class);

$inputValidator = \Sphp\Manual\api()->classLinker(OptionalValidator::class);

$formValidator = \Sphp\Manual\api()->classLinker(FormValidator::class);
$formInterface = \Sphp\Manual\api()->classLinker(\Sphp\Html\Forms\FormInterface::class);
$traversable = Apis::phpManual()->classLinker(\Traversable::class);
$arrayaccess = Apis::phpManual()->classLinker(\ArrayAccess::class);
$array = Apis::phpManual()->typeLink("array", "arrays");
\Sphp\Manual\parseDown(
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
CodeExampleBuilder::visualize('Sphp/Validators/FormValidator.php', 'php', false);
