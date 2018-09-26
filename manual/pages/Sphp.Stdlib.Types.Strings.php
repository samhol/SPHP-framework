<?php

namespace Sphp\Stdlib;

use Sphp\Manual;

$strLink = Manual\php()->typeLink('string');
$strings = Manual\api()->classLinker(Strings::class);

Manual\md(<<<MD
##The $strings class

$strings class is a static utility class for multibyte PHP $strLink manipulation, comparison and matching functions.
MD
);
Manual\example('Sphp/Stdlib/Strings.php', 'text', false)
        ->setExamplePaneTitle('Multibyte String utility example')
        ->setOutputSyntaxPaneTitle('String utility results')
        ->printHtml();
