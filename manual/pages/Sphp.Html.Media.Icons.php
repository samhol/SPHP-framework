<?php

namespace Sphp\Html\Media\Icons;

use Sphp\Manual;
use Sphp\Html\Foundation\Sites\Containers\Modal;
use Sphp\Html\Foundation\Sites\Containers\Popup;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

$icon = \Sphp\Manual\api()->classLinker(IconTag::class);
$devIcons = \Sphp\Manual\api()->classLinker(DevIcons::class);


\Sphp\Manual\md(<<<MD
# Icons and icon factories

$ns

Icon libraries represented here support assistive reading technologies.

MD
);


Manual\printPage('Sphp.Html.Media.Icons.Devicons');


$faIcon = Manual\api()->classLinker(FontAwesomeIcon::class);
$setSize = $faIcon->methodLink('setSize');
Manual\md(<<<MD
        
## Font Awesome icons

Font Awesome icons are a build feature of the framework. they can be used by 
creating a $icon or a $faIcon object.

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


\Sphp\Manual\md(<<<MD
        
## Other icon factories
  
Filetype icons and SVG country flags

MD
);

\Sphp\Manual\example('Sphp/Html/Media/Icons/FiletypeIcons.php')
        ->buildAccordion()
        ->printHtml();

use Sphp\Html\Div;

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
