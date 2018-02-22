<?php

namespace Sphp\Html\Media\Icons;

use Sphp\Html\Foundation\Sites\Containers\Modal;
use Sphp\Html\Foundation\Sites\Containers\Popup;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

$devIcons = \Sphp\Manual\api()->classLinker(DevIcons::class);

$devPopup = new Popup();
$devPopup->layout()->setSize('large');
$devPopup->addCssClass('icon-example-popup');
$devPopup->ajaxAppend('manual/snippets/icons/DevIcons.php');
$devModal = new Modal('DevIcons icons', $devPopup);
$devModal->getTrigger()->addCssClass('button', 'devicon', 'radius', 'small');

\Sphp\Manual\md(<<<MD
#Icons and icon factories

$ns

These icons are available as fonts and svg images. They support assistive reading technologies.
##Devicons <small>$devIcons factory</small> 

Devicon is a set of icons representing programming languages, designing and development tools.

$devModal
MD
);

\Sphp\Manual\example('Sphp/Html/Media/Icons/Icon.php')
        ->buildAccordion()->addCssClass('icons')
        ->printHtml();

$faPopup = new Popup();
$faPopup->layout()->setSize('large');
$faPopup->addCssClass('icon-example-popup');
$faPopup->ajaxAppend('manual/snippets/icons/FontAwesome.php');
$faModal = new Modal('FA icons', $faPopup);
$faModal->getTrigger()->addCssClass('button', 'fontawesome', 'radius', 'small');

\Sphp\Manual\md(<<<MD
        
##Font Awesome icons

CSS classes	and correspondin sizes

 * `fa-xs`	.75em
 * `fa-sm`	.875em
 * `fa-lg`	1.33em, also applies vertical-align: -25%
 * `fa-2x` through `fa-10x`	2em through 10em

$faModal
MD
);

\Sphp\Manual\example('Sphp/Html/Media/Icons/FaIcon.php')
        ->buildAccordion()->addCssClass('icons')
        ->printHtml();

$filePopup = new Popup();
$filePopup->layout()->setSize('large');
$filePopup->addCssClass('icon-example-popup');
$filePopup->ajaxAppend('manual/snippets/icons/Filesystem.php');
$fileModal = new Modal('Filesystem icons', $filePopup);
$fileModal->getTrigger()->addCssClass('button', 'alert', 'radius', 'small');

\Sphp\Manual\md(<<<MD
        
##Filetype icons

$fileModal
MD
);
