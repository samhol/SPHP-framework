<?php

namespace Sphp\Validation;
use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleViewer;
$nsLink = $api->getNamespaceLink(__NAMESPACE__);
$validatorInterface = $api->getClassLink(ValidatorInterface::class);
$requiredValueValidator = $api->getClassLink(RequiredValueValidator::class);
$patrnvLink = $api->getClassLink(PatternValidator::class);
$strLenValLink = $api->getClassLink(StringLengthValidator::class);
$abstractValidatorAggregate = $api->getClassLink(AbstractValidatorAggregate::class);
$validatorAggregate = $api->getClassLink(ValidatorAggregate::class);
$optionalValidatorInterface = $api->getClassLink(OptionalValidatorInterface::class);
$AbstractOptionalValidator = $api->getClassLink(AbstractOptionalValidator::class);
$ns = $api->getNamespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(
<<<MD
#User input Validation
 $ns 
User input validation is a critical part of any responsive HTML application. 
This Framework contains its own user input validation mechanism which includes 
both server- and clientside components. 	This section is about the serverside 
validation mechanism. The cornerstone of it is the $validatorInterface. This 
interface defines the minimum properties required for any SPHP framework based 
validator.
  
##The $requiredValueValidator and $optionalValidatorInterface validation
  
The $requiredValueValidator validates only that the given input has a non empty value. 	
        
**All of the following values are considered as empty:**
        
 1. {$php->getHyperlink("language.variables.php", '$var;')} (a variable declared, but without a value)
 2. {$php->getTypeLink(NULL)} values
 3.  empty {$php->getTypeLink([], "arrays")}	
 4. `""` an empty {$php->getTypeLink("string")}
 5. {$php->getTypeLink("string", "strings")} containing only following characters
      * " " (ASCII 32 (0x20)), an ordinary space 
      * "\\t" (ASCII 9 (0x09)), a tab 
      * "\\n" (ASCII 10 (0x0A)), a new line (line feed) 
      * "\\r" (ASCII 13 (0x0D)), a carriage return 
      * "\\0" (ASCII 0 (0x00)), the NUL-byte 
      * "\\x0B" (ASCII 11 (0x0B)), a vertical tab		

$optionalValidatorInterface makes it possible to choose whether the empty value 
is valid or not when validating user inputs with this type of validators. This 
property is usefull for example when the validated input is optional.	The abstract 
class $AbstractOptionalValidator is th default implementation of the 
$optionalValidatorInterface and is is also the base class for many of the build-in 
validators. 
        
MD
);
CodeExampleViewer::visualize(EXAMPLE_DIR . "Sphp/Validation/RequiredValueValidator.php", "php", false);
echo $parsedown->text(
<<<MD
##$optionalValidatorInterface validation
        
		
  

###The $patrnvLink class		
  
The $patrnvLink validates the input against the given regular expression. The input
is valid if it matches the pattern.
MD
);
  
CodeExampleViewer::visualize(EXAMPLE_DIR . "Sphp/Validation/PatternValidator.php", "php", false);
echo $parsedown->text(
<<<MD
###The $strLenValLink class	
        
The $strLenValLink simply validates the input length. This validator supports three 
types of validation
        
 1. Lower bound validation: the length of the input must be above a given limit. 
 2. Upper bound validation: the length of the input must be below a given limit.
 3. Range validation: the length of the input must be between the lower and upper limits. 
MD
);
CodeExampleViewer::visualize(EXAMPLE_DIR . "Sphp/Validation/StringLengthValidator.php", "php", false);
echo $parsedown->text(
<<<MD
##The $abstractValidatorAggregate implementations		
        
###The $validatorAggregate class		
        
The $validatorAggregate is an aggregation of $validatorInterface objects. It 
validates the given input against all of its inner $validatorInterface validators 
and the input is valid only if it passes all of them.
MD
);
CodeExampleViewer::visualize(EXAMPLE_DIR . "Sphp/Validation/ValueValidatorAggregate.php", "php", false);
$formValidator = $api->getClassLink(FormValidator::class);
$formInterface = $api->getClassLink(\Sphp\Html\Forms\FormInterface::class);
$traversable = $php->getClassLink(\Traversable::class);
$arrayaccess = $php->getClassLink(\ArrayAccess::class);$array = $php->getTypeLink("array", "arrays");
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
CodeExampleViewer::visualize(EXAMPLE_DIR . "Sphp/Validation/FormValidator.php", "php", false);
$abstractObjectValidator = $api->getClassLink(AbstractObjectValidator::class);
$userValidator = $api->getClassLink(UserValidator::class);
echo $parsedown->text(
<<<MD
##Creating custom validators		

Thera are obviously many vays to create own custom validators. However an easy 
way of doing so isto extend one of the $abstractValidatorAggregate, $validatorAggregate 
or $abstractObjectValidator classes. The choise between these three is dependent on 
the data type of the validable data.The following chapter describes one way of 
creating these custon validators.###The $userValidator class		
  
The $userValidator extends the $abstractObjectValidator and it can be used to validate 
{$api->getClassLink(\Sphp\Db\Objects\User::class)} object data.
MD
);
$reflector = new \ReflectionClass(UserValidator::class);
use \Sphp\Html\Foundation\F6\Containers\Accordions\SyntaxHighlightingSingleAccordion as SyntaxHighlightingSingleAccordion;
echo $reflector->getFileName();
/*$code = (new SyntaxHighlightingSingleAccordion())		
        ->setTitle("UserValidator PHP code")		
       //->loadFromFile($reflector->getFileName())		
        ->printHtml();*/

CodeExampleViewer::visualize(EXAMPLE_DIR . "Sphp/Validation/UserValidator.php", "php", false);
