<?php

namespace Sphp\Html\Media\Icons;

use Sphp\Html\Foundation\Sites\Containers\Modal;
use Sphp\Html\Foundation\Sites\Containers\Popup;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

$icon = \Sphp\Manual\api()->classLinker(IconTag::class);
$devIcons = \Sphp\Manual\api()->classLinker(DevIcons::class);


\Sphp\Manual\md(<<<MD

## Devicons <small>$devIcons icon factory</small> 

Devicon v2 library is a set of icons representing programming languages, 
designing and development tools. These icons are available as fonts and SVG 
images and they support assistive reading technologies.

MD
);

use Sphp\Html\Div;

$devPopup = new Popup();
$devPopup->layout()->setSize('large');
$devPopup->addCssClass('icon-example-popup', 'devicons');
$deviconsFontLoader = (new Div())->ajaxAppend('/manual/snippets/icons/devicons-font.php');
$devPopup->getContent()->append($deviconsFontLoader);
$devModal = new Modal('<strong>DevIcons</strong> font icons', $devPopup);


$devsvgPopup = new Popup();
$devsvgPopup->layout()->setSize('large');
$devsvgPopup->addCssClass('icon-example-popup', 'devicons');
$deviconsLoader = (new Div())->ajaxAppend('/manual/snippets/icons/devicons-svg.php');
$devsvgPopup->getContent()->append($deviconsLoader);
$devsvgModal = new Modal('<strong>DevIcons</strong> SVG icons', $devsvgPopup);

$devIconButtons = new \Sphp\Html\Foundation\Sites\Buttons\ButtonGroup();

$devIconButtons->appendButton($devsvgModal->getTrigger()->addCssClass('devicons', 'shadow', 'radius'));
$devIconButtons->appendButton($devModal->getTrigger()->addCssClass('devicons', 'shadow', 'radius'));
$devIconButtons->printHtml();

$devsvgModal->getPopup()->printHtml();
$devModal->getPopup()->printHtml();

