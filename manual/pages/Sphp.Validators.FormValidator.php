<?php

namespace Sphp\Validators;

$formValidator = \Sphp\Manual\api()->classLinker(FormValidator::class);
$formInterface = \Sphp\Manual\api()->classLinker(\Sphp\Html\Forms\FormInterface::class);
$traversable = \Sphp\Manual\php()->classLinker(\Traversable::class);
$arrayaccess = \Sphp\Manual\php()->classLinker(\ArrayAccess::class);
$array = \Sphp\Manual\php()->typeLink('array', 'arrays');

\Sphp\Manual\md(
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

\Sphp\Manual\visualize('Sphp/Validators/FormValidator.php', 'php', false);
