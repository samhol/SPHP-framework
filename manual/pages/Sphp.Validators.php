<?php

namespace Sphp\Validators;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$apigen = Apis::apigen();
$nsLink = Apis::apigen()->namespaceLink(__NAMESPACE__);
$validatorInterface = Apis::apigen()->classLinker(ValidatorInterface::class);
$requiredValueValidator = Apis::apigen()->classLinker(RequiredValueValidator::class);
$patrnvLink = $api->classLinker(PatternValidator::class);
$strLenValLink = $api->classLinker(StringLengthValidator::class);
$validatorAggregate = $api->classLinker(ValidatorAggregate::class);
$inputValidator = $api->classLinker(InputValidator::class);
$alphabetsOnly = $apigen->constantLink("Sphp\Regex\EN\ALPHABETS_ONLY");
$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
#DATA VALIDATION: <small>Introduction</small>
 $ns 
User input validation is a critical part of any responsive HTML application. 
This Framework contains its own user input validation mechanism which includes 
both server- and clientside components. 	This section is about the serverside 
validation mechanism. The cornerstone of it is the $validatorInterface. This 
interface defines the minimum properties required for any SPHP framework based 
validator.
  
##The $requiredValueValidator validation
  
The $requiredValueValidator validates only that the given input has a non empty value. 	
        
**All of the following values are considered as empty:**
        
 1. {$php->hyperlink("language.variables.php", '$var;')} (a variable declared, but without a value)
 2. {$php->typeLink(NULL)} values
 3.  empty {$php->typeLink([], "arrays")}	
 4. `""` an empty {$php->typeLink("string")}
 5. {$php->typeLink("string", "strings")} containing only following characters
      * " " (ASCII 32 (0x20)), an ordinary space 
      * "\\t" (ASCII 9 (0x09)), a tab 
      * "\\n" (ASCII 10 (0x0A)), a new line (line feed) 
      * "\\r" (ASCII 13 (0x0D)), a carriage return 
      * "\\0" (ASCII 0 (0x00)), the NUL-byte 
      * "\\x0B" (ASCII 11 (0x0B)), a vertical tab		

$inputValidator makes it possible to choose whether the empty value 
is valid or not when validating user inputs with this type of validators. This 
property is usefull for example when the validated input is optional.	The abstract 
class $inputValidator is th default implementation of the 
$inputValidator and is is also the base class for many of the build-in 
validators. 
        
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Validators/RequiredValueValidator.php", "php", false);

$load('Sphp.Validators.PatternValidator');
$load('Sphp.Validators.StringLengthValidator');
$load('Sphp.Validators.ValidatorChain');
$formValidator = $api->classLinker(FormValidator::class);
$formInterface = $api->classLinker(\Sphp\Html\Forms\FormInterface::class);
$traversable = $php->classLinker(\Traversable::class);
$arrayaccess = $php->classLinker(\ArrayAccess::class);
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
$abstractObjectValidator = $api->classLinker(AbstractObjectValidator::class);
$userValidator = $api->classLinker(UserValidator::class);
echo $parsedown->text(
        <<<MD
##Creating custom validators		

Thera are obviously many vays to create own custom validators. However an easy 
way of doing so isto extend one of the $abstractValidatorAggregate, $validatorAggregate 
or $abstractObjectValidator classes. The choise between these three is dependent on 
the data type of the validable data.
  
###The $userValidator class		
  
The $userValidator extends the $abstractObjectValidator and it can be used to validate 
{$api->classLinker(\Sphp\Db\Objects\User::class)} object data.
MD
);
$reflector = new \ReflectionClass(UserValidator::class);


//echo $reflector->getFileName();
/*$code = (new SyntaxHighlightingSingleAccordion())		
        ->setTitle("UserValidator PHP code")		
       //->loadFromFile($reflector->getFileName())		
        ->printHtml();*/

//CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Validation/UserValidator.php", "text", false);
