<?php

namespace Sphp\Html\Media\Icons;

use Sphp\Html\Foundation\Sites\Containers\Modal;
use Sphp\Html\Foundation\Sites\Containers\Popup;

$deviconFontPopup = new Popup();
$deviconFontPopup->setOption('multiple-opened', true);
$deviconFontPopup->layout()->setSize('large');
$deviconFontPopup->addCssClass('icon-example-popup', 'devicons');
$deviconFontModal = new Modal('<strong>DevIcons</strong> font icons', $deviconFontPopup);
$fontTrigger = $deviconFontModal->getTrigger()->addCssClass('icon-popup-trigger', 'shadow', 'radius');
$fontTrigger->setAttribute('data-url', '/manual/snippets/icons/devicons-font.php');


$devsvgPopup = new Popup();
$devsvgPopup->setOption('multiple-opened', true);
$devsvgPopup->layout()->setSize('large');
$devsvgPopup->addCssClass('icon-example-popup', 'devicons');
//$deviconsLoader = (new Div())->ajaxAppend('/manual/snippets/icons/devicons-svg.php');
//$devsvgPopup->getContent()->append($deviconsLoader);
$devsvgModal = new Modal('<strong>DevIcons</strong> SVG icons', $devsvgPopup);
$svgTrigger = $devsvgModal->getTrigger()->addCssClass('icon-popup-trigger', 'shadow', 'radius');
$svgTrigger->setAttribute('data-url', '/manual/snippets/icons/devicons-svg.php');
$devIconButtons = new \Sphp\Html\Foundation\Sites\Buttons\ButtonGroup();

$devIconButtons->appendButton($svgTrigger);
$devIconButtons->appendButton($fontTrigger);
$devIconButtons->printHtml();

$devsvgModal->getPopup()->printHtml();
$deviconFontPopup->printHtml();


$devFontinfopopup = new \Sphp\Html\Foundation\Sites\Containers\Popup('<div id="icon-info">foo is loading</div>');
$devFontinfopopup->attributes()->setAttribute('id', 'dev-icons-font-version-info');
$devFontinfopopup->setOption('multiple-opened', true)->layout()->setSize('large');;
echo $devFontinfopopup;