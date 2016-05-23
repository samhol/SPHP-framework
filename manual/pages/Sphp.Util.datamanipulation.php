<?php

namespace Sphp\Util;


//use Sphp\Html\Apps\SyntaxHighlightingAccordion as SyntaxHighlighter;
use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

//$code = new SyntaxHighlighter();
/* $result = (new SyntaxHighlighter())
  ->setHeading("Execution result"); */


//$config = $api->getClassLink(Config::class);
$namespace = $api->getNamespaceLink(__NAMESPACE__);
$boolLink = $php->getTypeLink("boolean");
$intLink = $php->getTypeLink("integer");
$floatLink = $php->getTypeLink("float");
$strLink = $php->getTypeLink("string");
$arrLink = $php->getTypeLink("array");
$stringsClass = $api->getClassLink(Strings::class);
$stringObjectClass = $api->getClassLink(StringObject::class);
echo $parsedown->text(<<<MD
#Data representation and manipulation classes in $namespace namespace
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

(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Util/multibyteStringProblems.php", "php", false))
        ->setExampleHeading("Multibyte string example PHP code")
        ->setOutputSyntaxPaneTitle("Multibyte string example results")
        ->printHtml();

$load("Sphp.Util.StringObject.php");
$load("Sphp.Util.Strings.php");
$load("Sphp.Util.Arrays.php");
$load("Sphp.Util.Filters.php");
$load("Sphp.Util.Datetime.php");
$load("Sphp.Util.BitMask.php");
