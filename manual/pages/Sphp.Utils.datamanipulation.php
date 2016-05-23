<?php

namespace Sphp\Util;

//use Sphp\Html\SyntaxHighlighter as SyntaxHighlighter;

use Sphp\Html\SyntaxHighlighter as SyntaxHighlighter,
	Sphp\Html\Tools\PHPExampleViewer as CodeExampleViewer;
use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$code = new SyntaxHighlighter();
/* $result = (new SyntaxHighlighter())
  ->setHeading("Execution result"); */

$load("Sphp.Util.Datetime.php");

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
#Data Manipulation classes in $namespace namespace
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
support `UTF-8` multibyte character encoding scheme.
MD
);

$load("Sphp.Util.Strings.php");

$wrapper = function($string) {
	return Strings::wrap($string, "`");
};
$enc = array_map($wrapper, StringObject::getSupportedEncodings());
$encodings = Arrays::implode($enc, ", ", " and ");
echo $parsedown->text(<<<MD
###The $stringObjectClass class
		
The $stringObjectClass class 
is a wrapper for native $strLink of any character encoding. It converts the wrapped
$strLink to `UTF-8` and provides some operations for this $stringObjectClass object to 
deal with the issues concerning multibyte encodings in PHP. 
		
$stringObjectClass class supports following encodings:

$encodings.
MD
);

(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Util/multibyteStringProblems.php", "php"))
		->setExampleHeading("Multibyte string example PHP code")
		->setOutputSyntaxPaneTitle("Multibyte string example results")
		->printHtml();

(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Util/String.php", true, "php"))
		->setExampleHeading("String object examples PHP code")
		->setOutputHeading("Results")
		->printHtml();
$load("Sphp.Util.Arrays.php");
$load("Sphp.Util.Filters.php");

$fileObject = $api->getClassLink(\Sphp\Util\LocalFile::class);
echo $parsedown->text(<<<MD
##The $fileObject class

$fileObject instance can handle file related (reading and writing) operations.
MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Util/FileObject1.php", false);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Util/FileObject2.php", "php");

echo $parsedown->text(<<<MD
$fileObject can also read <a href="http://en.wikipedia.org/wiki/Comma-separated_values" target="_blank">CSV-files</a> to a multidimensional PHP $arrLink where each 'row' represents a data row in the original CSV-file.
MD
);
echo $code->loadFromFile(\manual\CSV_PATH)->setPaneTitle("CSV-file example");
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Util/FileObject3.php", false);

