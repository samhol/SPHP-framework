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
Manual\printPage('Sphp.Html.Media.Icons.FontAwesome');


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


$flagPopup = new Popup('<div class="content"><h3>Icons are loading...</h3></div>');
$flagPopup->layout()->setSize('large');
$flagPopup->addCssClass('icon-example-popup', 'country-flags');
//$countryFlagsLoader = (new Div())->ajaxAppend('/manual/snippets/icons/countryFlags.php');
//$flagPopup->getContent()->append($countryFlagsLoader);
$flagModal = new Modal('<i class="far fa-flag fa-lg fa-fw"></i> Country flags', $flagPopup);
$otherButtons = new \Sphp\Html\Foundation\Sites\Buttons\ButtonGroup();

$otherButtons->appendButton($flagModal->getTrigger()->addCssClass('flags', 'shadow', 'radius') 
        ->setAttribute('data-sphp-iconset-url', '/manual/snippets/icons/countryFlags/app.php'));

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
