<?php

namespace Sphp\Html\Media\Icons;

use Sphp\Html\Foundation\Sites\Containers\Modal;
use Sphp\Html\Foundation\Sites\Containers\Popup;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

$devPopup = new Popup();
$devPopup->layout()->setSize('large');
$devPopup->ajaxAppend('manual/snippets/icons/DevIcons.php');
$devModal = new Modal('FA icons', $devPopup);
\Sphp\Manual\md(<<<MD
#Icons and icon factories
$ns      
##Devicons
        
$devModal
MD
);

\Sphp\Manual\example('Sphp/Html/Media/Icons/Icon.php')
        ->buildAccordion()->addCssClass('icons')
        ->printHtml();


//$d = $json->fromFile('manual/snippets/icons.json');
//print_r($data);

$faPopup = new Popup();
$faPopup->layout()->setSize('large');
$faPopup->ajaxAppend('manual/snippets/icons/FontAwesome.php');
$faModal = new Modal('FA icons', $faPopup);

\Sphp\Manual\md(<<<MD
        
##Font Awesome icons
        
Class	and correspondin size

 * `fa-xs`	.75em
 * `fa-sm`	.875em
 * `fa-lg`	1.33em, also applies vertical-align: -25%
 * `fa-2x` through `fa-10x`	2em through 10em

$faModal
MD
);


$filePopup = new Popup();
$filePopup->layout()->setSize('large');
$filePopup->ajaxAppend('manual/snippets/icons/Filesystem.php');
$fileModal = new Modal('Filesystem icons', $filePopup);
\Sphp\Manual\md(<<<MD
        
##Filetype icons

$fileModal
MD
);
