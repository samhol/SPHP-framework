<?php

namespace Sphp\Html\Foundation\Content;

/*$modal = (new ModalReveal())
		->ajaxReplace("http://sphp.samiholck.com/loremipsum.html")
		->addCssClass("radius")
		->printHtml();
$modal->createController(new HyperlinkButton)->setContent("Button controller")->printHtml();*/


$popup = (new PopupWindow());
		$popup->ajaxPrepend("http://sphp.samiholck.com/HtmlWiki.html");
		$popup->setOpenerContent("popup")->useDefaultCloser()->setSize("small");
		$popup->opener()->addCssClass(["button", "tiny", "radius"]);
$fullPopup = clone $popup;
echo "Here we have a small $popup and a full " . $fullPopup->setSize("full");	
//$popup->popup()->setId("gwreaq");
?>