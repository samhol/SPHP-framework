<?php

namespace Sphp\Stdlib;

use Sphp\Manual;

$boolLink = Manual\php()->typeLink('boolean');
$intLink = Manual\php()->typeLink('integer');
$floatLink = Manual\php()->typeLink('float');
$strLink = Manual\php()->typeLink('string');
$arrLink = Manual\php()->typeLink('array');
$stringsClass = Manual\api()->classLinker(Strings::class);
$stringObjectClass = Manual\api()->classLinker(MbString::class);
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
Manual\md(<<<MD
#STANDARD LIBRARY <small>extensions for PHP core functionality</small>
$ns

##PHP Unicode/multibyte $strLink manipulation
        
<div class="callout alert" markdown="1">
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
</div>
The $stringsClass and the $stringObjectClass classes
support `UTF-8` multibyte character encoding scheme. The difference between them 
is that the $stringObjectClass is an object oriented representation of a string 
whereas the $stringsClass is a static utility class containing methods for string 
manipulation.
MD
);

Manual\example('Sphp/Stdlib/Types/multibyteStringProblems.php', 'text', false)
        ->setExamplePaneTitle('Multibyte string example PHP code')
        ->setOutputSyntaxPaneTitle('Multibyte string example results')
        ->printHtml();

Manual\printPage('Sphp.Stdlib.Types.StringObject');
Manual\printPage('Sphp.Stdlib.Types.Strings');
Manual\printPage('Sphp.Stdlib.Types.Arrays');
Manual\printPage('Sphp.Stdlib.Types.BitMask');
Manual\printPage('Sphp.Stdlib.Types.URL');
