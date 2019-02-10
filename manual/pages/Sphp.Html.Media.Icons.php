<?php

namespace Sphp\Html\Media\Icons;

use Sphp\Html\Foundation\Sites\Containers\Modal;
use Sphp\Html\Foundation\Sites\Containers\Popup;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

$icon = \Sphp\Manual\api()->classLinker(FontIcon::class);
$devIcons = \Sphp\Manual\api()->classLinker(DevIcons::class);


\Sphp\Manual\md(<<<MD
#Icons and icon factories

$ns

These icons are available as fonts and svg images. They support assistive reading technologies.

##Devicons <small>$devIcons factory</small> 

Devicon is a set of icons representing programming languages, designing and development tools.


MD
);

$devPopup = new Popup();
$devPopup->layout()->setSize('large');
$devPopup->addCssClass('icon-example-popup');
$devPopup->ajaxAppend('manual/snippets/icons/DevIcons.php');
$devModal = new Modal('<i class="devicon-devicon-plain fa-lg fa-fw"></i> DevIcons icons', $devPopup);
$devModal->getTrigger()->addCssClass('button', 'devicon', 'radius', 'small', 'shadow');
echo $devModal;

$flagPopup = new Popup();
$flagPopup->layout()->setSize('large');
$flagPopup->addCssClass('icon-example-popup');
$flagPopup->ajaxAppend('manual/snippets/icons/countryFlags.php');
$flagModal = new Modal('<i class="far fa-flag fa-lg fa-fw"></i> Country flags', $flagPopup);
$flagModal->getTrigger()->addCssClass('small', 'fontawesome', 'shadow', 'radius', 'button');
echo $flagModal;

$farPopup = new Popup();
$farPopup->layout()->setSize('large');
$farPopup->addCssClass('icon-example-popup');
$farPopup->ajaxAppend('manual/snippets/icons/FontAwesome.php?type=regular');
$farModal = new Modal('<i class="fab fa-font-awesome-alt fa-lg fa-fw"></i> Regular icons', $farPopup);

$fasPopup = new Popup();
$fasPopup->layout()->setSize('large');
$fasPopup->addCssClass('icon-example-popup');
$fasPopup->ajaxAppend('manual/snippets/icons/FontAwesome.php?type=solid');
$fasModal = new Modal('<i class="fab fa-font-awesome-alt fa-lg fa-fw"></i> Solid icons', $fasPopup);

$fabPopup = new Popup();
$fabPopup->layout()->setSize('large');
$fabPopup->addCssClass('icon-example-popup');
$fabPopup->ajaxAppend('manual/snippets/icons/FontAwesome.php?type=brand');
$fabModal = new Modal('<i class="fab fa-font-awesome-alt fa-lg fa-fw"></i> Brand icons', $fabPopup);

$buttonGroup = new \Sphp\Html\Foundation\Sites\Buttons\ButtonGroup();
$buttonGroup->setSize('small');
$buttonGroup->appendButton($fasModal->getTrigger()->addCssClass('fontawesome', 'shadow', 'radius'));
$buttonGroup->appendButton($farModal->getTrigger()->addCssClass('fontawesome', 'shadow', 'radius'));
$buttonGroup->appendButton($fabModal->getTrigger()->addCssClass('fontawesome', 'shadow', 'radius'));

$faIcon = \Sphp\Manual\api()->classLinker(FaIcon::class);
$setSize = $faIcon->methodLink('setSize');
\Sphp\Manual\md(<<<MD
        
## Font Awesome icons

Font Awesome icons are a build feature of the framework. they can be used by 
creating a $icon or a $faIcon object.
MD
);
$buttonGroup->printHtml();

$fasPopup->printHtml();
$farPopup->printHtml();
$fabPopup->printHtml();
\Sphp\Manual\md(<<<MD
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

\Sphp\Manual\example('Sphp/Html/Media/Icons/FaIcon.php')
        ->buildAccordion()
        ->printHtml();


\Sphp\Manual\md(<<<MD
        
##Filetype icons

MD
);

$filePopup = new Popup();
$filePopup->layout()->setSize('large');
$filePopup->addCssClass('icon-example-popup');
$filePopup->ajaxAppend('manual/snippets/icons/Filesystem.php');
$fileModal = new Modal('<i class="far fa-folder-open fa-lg fa-fw"></i> <b>Filesystem icons</b>', $filePopup);
$fileModal->getTrigger()->addCssClass('button', 'folder', 'radius', 'small', 'shadow');
$fileModal->printHtml();

\Sphp\Manual\example('Sphp/Html/Media/Icons/FiletypeIcons.php')
        ->buildAccordion()
        ->printHtml();
