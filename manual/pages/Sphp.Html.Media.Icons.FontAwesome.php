<?php

namespace Sphp\Html\Media\Icons;

use Sphp\Manual;


$icon = Manual\api()->classLinker(IconTag::class);
$faIcon = Manual\api()->classLinker(FontAwesomeIcon::class);
$setSize = $faIcon->methodLink('setSize');
Manual\md(<<<MD
        
## Font Awesome icons

Font Awesome icons can be used by creating a $icon or a $faIcon object.

$faIcon Icon size can be changed simply by calling $setSize method with a Font 
Awesome CSS class (or a short hand version of it by simply removing the `fa-` 
from the begining of the size class)

**Sizes are:**
 * `fa-xs` - .75em
 * `fa-sm` - .875em
 * `fa-lg` - 1.33em, also applies vertical-align: -25%
 * `fa-2x` through `fa-10x` -	2em through 10em

MD
);
include './manual/snippets/icons/fontawesome/app.php';

\Sphp\Manual\example('Sphp/Html/Media/Icons/FaIcon.php')
        ->buildAccordion()
        ->printHtml();
