<?php

namespace Sphp\Stdlib;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$namespace = Apis::sami()->namespaceLink(__NAMESPACE__);
$boolLink = Apis::phpManual()->typeLink('boolean');
$intLink = Apis::phpManual()->typeLink('integer');
$floatLink = Apis::phpManual()->typeLink('float');
$strLink = Apis::phpManual()->typeLink('string');
$arrLink = Apis::phpManual()->typeLink('array');
$stringsClass = Apis::sami()->classLinker(Strings::class);
$stringObjectClass = Apis::sami()->classLinker(StringObject::class);
$nsbc = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
#Core objects and utlility classes
$nsbc
This namespace contains a group of data manipulation classes for various commonly needed tasks 
like PHP $strLink and PHP $arrLink manipulation. 

##PHP Unicode/multibyte $strLink manipulation

####Unicode Support in PHP

<blockquote class="text-justify" cite="http://www.sitepoint.com/bringing-unicode-to-php-with-portable-utf8/">
PHP’s lack of Unicode/multibyte support means that the standard string handling 
functions treat strings as a sequence of single-byte characters. In fact, the 
official manual defines a string in PHP as a “series of characters, where a 
character is the same as a byte.” PHP supports only 8-bit characters, while 
Unicode (and many other character sets) may require more than one byte to represent 
a character. This limitation of PHP affects almost all aspects of string manipulation,
including (but not limited to) substring extraction, determining string lengths, 
string splitting, shuffling etc.<cite>www.sitepoint.com</cite></blockquote>
		
The $stringsClass and the $stringObjectClass classes in $namespace namespace 
support `UTF-8` multibyte character encoding scheme. The difference between them 
is that the $stringObjectClass is an object oriented representation of a string 
whereas the $stringsClass is a static utility class containing methods for string 
manipulation.
MD
);

(new CodeExampleBuilder('Sphp/Stdlib/Types/multibyteStringProblems.php', 'text', false))
        ->setExamplePaneTitle('Multibyte string example PHP code')
        ->setOutputSyntaxPaneTitle('Multibyte string example results')
        ->printHtml();

$load('Sphp.Stdlib.Types.StringObject');
$load('Sphp.Stdlib.Types.Strings');
$load('Sphp.Stdlib.Types.Arrays');
$load('Sphp.Stdlib.Types.Datetime');
$load('Sphp.Stdlib.Types.BitMask');
$load('Sphp.Stdlib.Types.URL');
