<?php

use Sphp\Html\Media\Icons\FontAwesome;
use Sphp\Html\Foundation\Sites\Containers\Popup;
use Sphp\Html\Foundation\Sites\Containers\Modal;
use Sphp\Html\Foundation\Sites\Buttons\ButtonGroup;

$fa = new FontAwesome();
$fa->fixedWidth(true)->setSize('lg');
$faIconAlt = $fa('fab fa-font-awesome-alt');
$farPopup = new Popup('<div class="content"><h3>Icons are loading...</h3></div>');
$farPopup->layout()->setSize('large');
$farPopup->addCssClass('icon-example-popup', 'fontawesome');
$farModal = new Modal("$faIconAlt Regular icons", $farPopup);

$fasPopup = new Popup('<div class="content"><h3>Icons are loading...</h3></div>');
$fasPopup->layout()->setSize('large');
$fasPopup->addCssClass('icon-example-popup', 'fontawesome');
$fasModal = new Modal("$faIconAlt Solid icons", $fasPopup);

$fabPopup = new Popup('<div class="content"><h3>Icons are loading...</h3></div>');
$fabPopup->layout()->setSize('large');
$fabPopup->addCssClass('icon-example-popup', 'fontawesome');
$fabModal = new Modal("$faIconAlt Brand icons", $fabPopup);

$faButtons = new ButtonGroup();
$fasButton = $fasModal->getTrigger();
$fasButton->addCssClass('fontawesome', 'shadow', 'radius')
        ->setAttribute('data-sphp-iconset-url', '/manual/snippets/icons/fontawesome/versions.php?type=solid');
$faButtons->appendButton($fasButton);

$farButton = $farModal->getTrigger();
$farButton->addCssClass('fontawesome', 'shadow', 'radius')
        ->setAttribute('data-sphp-iconset-url', '/manual/snippets/icons/fontawesome/versions.php?type=regular');
$faButtons->appendButton($farButton);

$fabButton = $fabModal->getTrigger();
$fabButton->addCssClass('fontawesome', 'shadow', 'radius')
        ->setAttribute('data-sphp-iconset-url', '/manual/snippets/icons/fontawesome/versions.php?type=brands');
$faButtons->appendButton($fabButton);

$faButtons->printHtml();
$fasPopup->printHtml();
$farPopup->printHtml();
$fabPopup->printHtml();
