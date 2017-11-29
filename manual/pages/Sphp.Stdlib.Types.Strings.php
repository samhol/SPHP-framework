<?php

namespace Sphp\Stdlib;

use Sphp\Manual;

$strLink = Manual\php()->typeLink('string');
$strings = Manual\api()->classLinker(Strings::class);

Manual\parseDown(<<<MD
##The $strings class

$strings class is a static utility class for multibyte PHP $strLink comparison and matching.
MD
);
Manual\example('Sphp/Stdlib/Types/Strings1.php', 'text', false)
        ->setExamplePaneTitle('Multibyte String testing example')
        ->setOutputSyntaxPaneTitle('String testing results')
        ->printHtml();

Manual\parseDown(<<<MD
$strings class has also a couple of handy PHP $strLink manipulation functions.
MD
);

Manual\example('Sphp/Stdlib/Types/Strings2.php', 'text', false)
        ->setExamplePaneTitle('Multibyte String manipulation example')
        ->setOutputSyntaxPaneTitle('String manipulation results')
        ->printHtml();
