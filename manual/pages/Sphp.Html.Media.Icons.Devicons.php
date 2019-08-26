<?php

namespace Sphp\Html\Media\Icons;

use Sphp\Html\Foundation\Sites\Containers\Modal;
use Sphp\Html\Foundation\Sites\Containers\Popup;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

$icon = \Sphp\Manual\api()->classLinker(FontIcon::class);
$devIcons = \Sphp\Manual\api()->classLinker(DevIcons::class);


\Sphp\Manual\md(<<<MD

##Devicons <small>$devIcons factory</small> 

Devicon is a set of icons representing programming languages, designing and development tools.    
These icons are available as fonts and svg images. They support assistive reading technologies.

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


$filePopup = new Popup();
$filePopup->layout()->setSize('large');
$filePopup->addCssClass('icon-example-popup', 'filesystem');
$fileIconLoader = (new Div())->ajaxAppend('/manual/snippets/icons/Filesystem.php');
$filePopup->getContent()->append($fileIconLoader);
$fileModal = new Modal('<i class="far fa-folder-open fa-lg fa-fw"></i> <b>Filesystem icons</b>', $filePopup);
//$fileModal->getTrigger()->addCssClass('button', 'folder', 'radius', 'small', 'shadow');
//$fileModal->printHtml();

$buttonGroup = new \Sphp\Html\Foundation\Sites\Buttons\ButtonGroup();

$buttonGroup->appendButton($fileModal->getTrigger()->addCssClass('folder', 'shadow', 'radius'));

$buttonGroup->printHtml();

$devsvgModal->getPopup()->printHtml();
$devModal->getPopup()->printHtml();
$fileModal->getPopup()->printHtml();

$faIcon = \Sphp\Manual\api()->classLinker(FontAwesomeIcon::class);
$setSize = $faIcon->methodLink('setSize');
