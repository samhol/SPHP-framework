<?php

namespace Sphp\Html\Media\Icons;

use Sphp\Html\Foundation\Sites\Containers\Modal;
use Sphp\Html\Foundation\Sites\Containers\Popup;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

$icon = \Sphp\Manual\api()->classLinker(IconTag::class);
$devIcons = \Sphp\Manual\api()->classLinker(DevIcons::class);


\Sphp\Manual\md(<<<MD
# Icons and icon factories

$ns

These icons are available as fonts and svg images. They support assistive reading technologies.

##Devicons <small>$devIcons factory</small> 

Devicon is a set of icons representing programming languages, designing and development tools.


MD
);

use Sphp\Html\Div;

$devPopup = new Popup();
$devPopup->layout()->setSize('large');
$devPopup->addCssClass('icon-example-popup', 'devicons');
$deviconsFontLoader = (new Div())->ajaxAppend('/manual/snippets/icons/devicons-font.php');
$devPopup->getContent()->append($deviconsFontLoader);
$devModal = new Modal('<i class="devicon-devicon-plain fa-lg fa-fw"></i> DevIcons icons', $devPopup);


$devsvgPopup = new Popup();
$devsvgPopup->layout()->setSize('large');
$devsvgPopup->addCssClass('icon-example-popup', 'devicons');
$deviconsLoader = (new Div())->ajaxAppend('/manual/snippets/icons/devicons-svg.php');
$devsvgPopup->getContent()->append($deviconsLoader);
$devsvgModal = new Modal('<i class="devicon-devicon-plain fa-lg fa-fw"></i> DevIcons SVG', $devsvgPopup);

$devIconButtons = new \Sphp\Html\Foundation\Sites\Buttons\ButtonGroup();

$devIconButtons->setSize('small')->setExtended();
$devIconButtons->appendButton($devsvgModal->getTrigger()->addCssClass('devicons', 'shadow', 'radius'));
$devIconButtons->appendButton($devModal->getTrigger()->addCssClass('devicons', 'shadow', 'radius'));
$devIconButtons->printHtml();

//$flagModal->getTrigger()->addCssClass('small', 'fontawesome', 'shadow', 'radius', 'button');
//echo $flagModal;


$devsvgModal->getPopup()->printHtml();
$devModal->getPopup()->printHtml();

$faIcon = \Sphp\Manual\api()->classLinker(FontAwesomeIcon::class);
$setSize = $faIcon->methodLink('setSize');
\Sphp\Manual\md(<<<MD
        
## Font Awesome icons

Font Awesome icons are a build feature of the framework. they can be used by 
creating a $icon or a $faIcon object.
MD
);
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
$fa = new FontAwesome();
$fa->fixedWidth(true)->setSize('lg');
$farPopup = new Popup();
$farPopup->layout()->setSize('large');
$farPopup->addCssClass('icon-example-popup', 'fontawesome');

$regularLoader = (new Div())->ajaxAppend('/manual/snippets/icons/fontawesome.php?type=regular');
$farPopup->getContent()->append($regularLoader);
$farModal = new Modal("{$fa('fab fa-font-awesome-alt')} Regular icons", $farPopup);

$fasPopup = new Popup();
$fasPopup->layout()->setSize('large');
$fasPopup->addCssClass('icon-example-popup', 'fontawesome');
$solidLoader = (new Div())->ajaxAppend('/manual/snippets/icons/fontawesome.php?type=solid');
$fasPopup->getContent()->append($solidLoader);
$fasModal = new Modal('<i class="fab fa-font-awesome-alt fa-lg fa-fw"></i> Solid icons', $fasPopup);

$fabPopup = new Popup();
$fabPopup->layout()->setSize('large');
$fabPopup->addCssClass('icon-example-popup', 'fontawesome');
$brandsLoader = (new Div())->ajaxAppend('/manual/snippets/icons/fontawesome.php?type=brands');
$fabPopup->getContent()->append($brandsLoader);
$fabModal = new Modal('<i class="fab fa-font-awesome-alt fa-lg fa-fw"></i> Brand icons', $fabPopup);

$faButtons = new \Sphp\Html\Foundation\Sites\Buttons\ButtonGroup();

$faButtons->appendButton($fasModal->getTrigger()->addCssClass('fontawesome', 'shadow', 'radius'));
$faButtons->appendButton($farModal->getTrigger()->addCssClass('fontawesome', 'shadow', 'radius'));
$faButtons->appendButton($fabModal->getTrigger()->addCssClass('fontawesome', 'shadow', 'radius'));
$faButtons->printHtml();
$fasPopup->printHtml();
$farPopup->printHtml();
$fabPopup->printHtml();
\Sphp\Manual\example('Sphp/Html/Media/Icons/FaIcon.php')
        ->buildAccordion()
        ->printHtml();


\Sphp\Manual\md(<<<MD
        
## Other icons
  
Filetype icons and SVG country flags

MD
);

\Sphp\Manual\example('Sphp/Html/Media/Icons/FiletypeIcons.php')
        ->buildAccordion()
        ->printHtml();


$filePopup = new Popup();
$filePopup->layout()->setSize('large');
$filePopup->addCssClass('icon-example-popup', 'filesystem');
$fileIconLoader = (new Div())->ajaxAppend('/manual/snippets/icons/Filesystem.php');
$filePopup->getContent()->append($fileIconLoader);
$fileModal = new Modal('<i class="far fa-folder-open fa-lg fa-fw"></i> <b>Filesystem icons</b>', $filePopup);
//$fileModal->getTrigger()->addCssClass('button', 'folder', 'radius', 'small', 'shadow');
//$fileModal->printHtml();


$flagPopup = new Popup();
$flagPopup->layout()->setSize('large');
$flagPopup->addCssClass('icon-example-popup', 'country-flags');
$countryFlagsLoader = (new Div())->ajaxAppend('/manual/snippets/icons/countryFlags.php');
$flagPopup->getContent()->append($countryFlagsLoader);
$flagModal = new Modal('<i class="far fa-flag fa-lg fa-fw"></i> Country flags', $flagPopup);
$otherButtons = new \Sphp\Html\Foundation\Sites\Buttons\ButtonGroup();

$otherButtons->appendButton($flagModal->getTrigger()->addCssClass('flags', 'shadow', 'radius'));

$otherButtons->appendButton($fileModal->getTrigger()->addCssClass('folder', 'shadow', 'radius'));

$otherButtons->printHtml();
$fileModal->getPopup()->printHtml();
$flagModal->getPopup()->printHtml();

\Sphp\Manual\md(<<<MD

## Icon resources

1. **Font Awesome:** https://fontawesome.com/
2. **Devicon 2.0:** https://konpa.github.io/devicon/     
3. **Jam Icons:** https://jam-icons.com/
4. **Material Design Icons:** https://materialdesignicons.com/

MD
);
