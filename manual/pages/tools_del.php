<?php

namespace Sphp\Util;

//use Sphp\Html\SyntaxHighlighter as SyntaxHighlighter;

use Sphp\Html\SyntaxHighlighter as SyntaxHighlighter,
	Sphp\Html\Tools\PHPExampleViewer as CodeExampleViewer;

$code = new SyntaxHighlighter();
/* $result = (new SyntaxHighlighter())
  ->setHeading("Execution result"); */


$config = $api->getClassLink(Config::class);
$toolsLink = $api->getNamespaceLink(__NAMESPACE__);
$boolLink = $php->getTypeLink("boolean");
$intLink = $php->getTypeLink("integer");
$floatLink = $php->getTypeLink("float");
$strLink = $php->getTypeLink("string");
$arrLink = $php->getTypeLink("array");
echo $parsedown->text(<<<MD
#The $toolsLink namespace
This namespace contains a group of tool classes for various commonly needed tasks 
like PHP $strLink and PHP $arrLink manipulation. 
		
##The $config configuration strorage class

**Problem?**
		
Extensive usage of constants in any programming language is usually considered as a bad 
practice. PHP constant can contain only scalar data ($boolLink, $intLink, $floatLink 
and $strLink), which limits the usability.
		
**Namespace pollution:** Using PHP constants in global namespace to store configuration 
variables pollutes the global namespace, which can lead to collisions when implementing 
other code. Ofcourse a simple solution for this problem is to define constants in different 
namespaces and/or to use class constants when possible.
		
**Solution:**
		
The $config class can be used to store any type of configuration data in an singelton object. 
This data is reachable from anywhere an the data can also be manipulated if nessesary.
		
The singelton $config instance is a map that associates configuration values to their 
names. These value names are casted according to the rules defined for PHP array keys.

####The following examples illustrate how the $config class can be used
MD
);

echo $code->loadFromFile(EXAMPLE_DIR . "Sphp/Util/Config1.php")->setPaneTitle("Config instance example");
echo $code->loadFromFile(EXAMPLE_DIR . "Sphp/Util/Config2.php")->setPaneTitle("Config example using Array notation");
echo $code->loadFromFile(EXAMPLE_DIR . "Sphp/Util/Config3.php")->setPaneTitle("Static Config example");

$stringClass = $api->getClassLink(StringObject::class);
$wrapper = function($string) {
	return Strings::wrap($string, "`");
};
$enc = array_map($wrapper, StringObject::getSupportedEncodings());
$encodings = Arrays::implode($enc, ", ", " and ");
echo $parsedown->text(<<<MD
##The $stringClass class for multibyte encoded strings
		
Multibyte character encoding schemes like `UTF-8` were developed to express more 
than 256 characters in the regular bytewise coding system. the $stringClass class 
is a wrapper  for native $strLink of any character encoding. It converts the wrapped
$strLink to `UTF-8` and provides some operations for this $stringClass object to 
deal with the issues concerning multibyte encodings in PHP. 
		
$stringClass class supports following encodings:

$encodings.
MD
);

(new CodeExampleViewer(EXAMPLE_DIR . "Sphp/Util/multibyteStringProblems.php", true, "php"))
		->setExampleHeading("Multibute string example PHP code")
		->setOutputHeading("Multibute string example results")
		->printHtml();

(new CodeExampleViewer(EXAMPLE_DIR . "Sphp/Util/String.php", true, "php"))
		->setExampleHeading("String object examples PHP code")
		->setOutputHeading("Results")
		->printHtml();
$load("Sphp.Util.Strings.php");
$load("Sphp.Util.Arrays.php");

$fileObject = $api->getClassLink(\Sphp\Util\LocalFile::class);
echo $parsedown->text(<<<MD
##The $fileObject class

$fileObject instance can handle file related (reading and writing) operations.
MD
);

CodeExampleViewer::visualize(EXAMPLE_DIR . "Sphp/Util/FileObject1.php", false);
CodeExampleViewer::visualize(EXAMPLE_DIR . "Sphp/Util/FileObject2.php", true, "php");

echo $parsedown->text(<<<MD
$fileObject can also read <a href="http://en.wikipedia.org/wiki/Comma-separated_values" target="_blank">CSV-files</a> to a multidimensional PHP $arrLink where each 'row' represents a data row in the original CSV-file.
MD
);
echo $code->loadFromFile(\manual\CSV_PATH)->setPaneTitle("CSV-file example");
CodeExampleViewer::visualize(EXAMPLE_DIR . "Sphp/Util/FileObject3.php", false);

