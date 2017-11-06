<?php

namespace Sphp\Validators;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$php = Apis::phpManual();
$nsLink = \Sphp\Manual\api()->namespaceLink(__NAMESPACE__);
$validatorInterface = \Sphp\Manual\api()->classLinker(ValidatorInterface::class);
$requiredValueValidator = \Sphp\Manual\api()->classLinker(NotEmptyValidator::class);
$patrnvLink = \Sphp\Manual\api()->classLinker(PatternValidator::class);
$strLenValLink = \Sphp\Manual\api()->classLinker(StringLengthValidator::class);
$inputValidator = \Sphp\Manual\api()->classLinker(OptionalValidator::class);
$alphabetsOnly = \Sphp\Manual\api()->constantLink("Sphp\Regex\EN\ALPHABETS_ONLY");
$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
\Sphp\Manual\parseDown(<<<MD
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
CodeExampleBuilder::visualize("Sphp/Validators/RequiredValueValidator.php", "php", false);

\Sphp\Manual\loadPage('Sphp.Validators.PatternValidator');
\Sphp\Manual\loadPage('Sphp.Validators.StringLengthValidator');
\Sphp\Manual\loadPage('Sphp.Validators.ValidatorChain');
\Sphp\Manual\loadPage('Sphp.Validators.FormValidator');

/*\Sphp\Manual\parseDown(<<<MD
##Creating custom validators		

Thera are obviously many vays to create own custom validators. However an easy 
way of doing so isto extend one of the $abstractValidatorAggregate or
$validatorAggregate  classes. The choise between these three is dependent on 
the data type of the validable data.

MD
);*/

