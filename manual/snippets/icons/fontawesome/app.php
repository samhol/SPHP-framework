<?php

use Sphp\Html\Media\Icons\FontAwesome;
use Sphp\Html\Div;
use Sphp\Html\Foundation\Sites\Containers\Popup;
use Sphp\Html\Foundation\Sites\Containers\Modal;
use Sphp\Html\Foundation\Sites\Buttons\ButtonGroup;

$fa = new FontAwesome();
$fa->fixedWidth(true)->setSize('lg');
$faIconAlt = $fa('fab fa-font-awesome-alt');
$farPopup = new Popup();
$farPopup->layout()->setSize('large');
$farPopup->addCssClass('icon-example-popup', 'fontawesome');
$regularLoader = (new Div())->ajaxAppend('/manual/snippets/icons/fontawesome/versions.php?type=regular');
$farPopup->getContent()->append($regularLoader);
$farModal = new Modal("$faIconAlt Regular icons", $farPopup);

$fasPopup = new Popup();
$fasPopup->layout()->setSize('large');
$fasPopup->addCssClass('icon-example-popup', 'fontawesome');
$solidLoader = (new Div())->ajaxAppend('/manual/snippets/icons/fontawesome/versions.php?type=solid');
$fasPopup->getContent()->append($solidLoader);
$fasModal = new Modal("$faIconAlt Solid icons", $fasPopup);

$fabPopup = new Popup();
$fabPopup->layout()->setSize('large');
$fabPopup->addCssClass('icon-example-popup', 'fontawesome');
$brandsLoader = (new Div())->ajaxAppend('/manual/snippets/icons/fontawesome/versions.php?type=brands');
$fabPopup->getContent()->append($brandsLoader);
$fabModal = new Modal("$faIconAlt Brand icons", $fabPopup);

$faButtons = new ButtonGroup();

$faButtons->appendButton($fasModal->getTrigger()->addCssClass('fontawesome', 'shadow', 'radius'));
$faButtons->appendButton($farModal->getTrigger()->addCssClass('fontawesome', 'shadow', 'radius'));
$faButtons->appendButton($fabModal->getTrigger()->addCssClass('fontawesome', 'shadow', 'radius'));
$faButtons->printHtml();
$fasPopup->printHtml();
$farPopup->printHtml();
$fabPopup->printHtml();
