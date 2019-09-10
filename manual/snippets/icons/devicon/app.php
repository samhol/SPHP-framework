<?php

use Sphp\Html\Foundation\Sites\Containers\Modal;

$deviconFontModal = new Modal('<strong>DevIcons</strong> font icons', '<div class="content"><h3>Icons are loading...</h3></div>');
$deviconFontModal->getPopup()
        ->addCssClass('icon-example-popup')
        ->setOption('multiple-opened', true)
        ->layout()
        ->setSize('large');
$fontTrigger = $deviconFontModal->getTrigger()->addCssClass('icon-popup-trigger', 'shadow', 'radius', 'devicons');
$fontTrigger->setAttribute('data-sphp-iconset-url', '/manual/snippets/icons/devicon/font-version.php');

$devsvgModal = new Modal('<strong>DevIcons</strong> SVG icons', '<div class="content"><h3>Icons are loading...</h3></div>');
$devsvgModal->getPopup()
        ->addCssClass('icon-example-popup')
        ->setOption('multiple-opened', true)
        ->layout()
        ->setSize('large');
$svgTrigger = $devsvgModal->getTrigger()->addCssClass('icon-popup-trigger', 'shadow', 'radius', 'devicons');
$svgTrigger->setAttribute('data-sphp-iconset-url', '/manual/snippets/icons/devicon/svg-version.php');
$devIconButtons = new \Sphp\Html\Foundation\Sites\Buttons\ButtonGroup();

$devIconButtons->appendButton($svgTrigger);
$devIconButtons->appendButton($fontTrigger);
$devIconButtons->printHtml();

$devsvgModal->getPopup()->printHtml();
$deviconFontModal->getPopup()->printHtml();


$devFontinfopopup = new \Sphp\Html\Foundation\Sites\Containers\Popup('<div id="icon-info"><h3>Icons are loading...</h3></div>');
$devFontinfopopup->attributes()->setAttribute('id', 'dev-icons-font-version-info');
$devFontinfopopup->setOption('multiple-opened', true)->layout()->setSize('large');

echo $devFontinfopopup;
