<?php

namespace Sphp\Html\Foundation\Content\Popups;

$popup = (new Revealer());
$popup->popup("small popup")->ajaxPrepend("http://sphp.samiholck.com/HtmlWiki.html");
$popup->setOpenerContent("popup")->useDefaultCloser()->setSize("small");
$popup->opener()->addCssClass(["button", "tiny", "radius"]);

$fullPopup = clone $popup;
$fullPopup->setSize("full")
        ->setOpenerContent("full popup");
echo "$popup $fullPopup";
?>