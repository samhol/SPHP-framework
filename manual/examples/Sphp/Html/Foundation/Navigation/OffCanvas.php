<?php

namespace Sphp\Html\Foundation\Navigation\OffCanvas;

$offCanvas = (new OffCanvas("Off-canvas"));
$leftMenu = new LeftMenu("Left menu");
$offCanvas->useLeftMenu(TRUE)
		->leftMenu()
		->appendLabel("Left Off-canvas menu")
		->appendLink("http://www.google.com/", "Google", "_blank")
		->appendLabel("Left Off-canvas menu")
		->appendLink("http://www.google.com/", "Google", "_blank")
		->appendLink("http://www.google.com/", "Google", "_blank")
		->append((new SubMenu("left-submenu"))->appendLink("http://yahoo.com", "yahoo.com"));
$offCanvas->useRightMenu(TRUE)
		->rightMenu()
		->appendLabel("Right Off-canvas menu")
		->appendLink("http://www.google.com/", "Google", "_blank")
		->appendLabel("label 1")
		->appendLink("http://www.google.com/", "Google", "_blank")
		->appendLink("http://www.google.com/", "Google", "_blank")
		->append((new SubMenu("left-submenu"))->appendLink("http://yahoo.com", "yahoo.com"));
$offCanvas->mainContent()
		->ajaxAppend("http://sphp.samiholck.com/HtmlWiki.html")
		->addCssClass("panel callout");
/* $packages = (new DropDownMenu("Menu 1"))
  ->appendLink("http://www.google.com/", "Google", "_blank")
  ->appendSeparator("separator:")
  ->appendSubmenu((new DropDownMenu("Submenu 1"))
  ->appendLink("http://www.google.com/", "Google", "_blank")
  ->appendLink("http://www.google.com/", "Google", "_blank")
  ->appendSeparator("separator:", TRUE)
  ->appendLink("http://www.google.com/", "Google", "_blank")
  ->appendLink("http://www.google.com/", "Google", "_blank"));

  $subMenu = (new DropDownMenu("More google"))
  ->appendLink("http://www.google.com/", "Google", "_blank")
  ->appendSubmenu((new DropDownMenu("Submenu 1"))
  ->appendLink("http://www.google.com/", "Google", "_blank")
  ->appendLink("http://www.google.com/", "Google", "_blank")
  ->appendSeparator("separator:", TRUE)
  ->appendLink("http://www.google.com/", "Google", "_blank")
  ->appendLink("http://www.google.com/", "Google", "_blank"));
  $subMenu->appendLink("http://www.google.com/", "Google", "_blank");
  $packages->append($subMenu);

  $navi->left()->appendDivider()->append($packages)->appendDivider();
  $navi->right()
  ->appendButtonLink("https://github.com/samhol/SPH-framework", "GitHub", "_blank")
  ->appendButtonLink("https://github.com/samhol/SPH-framework/releases", "DOWNLOAD", "_blank"); */
$offCanvas->printHtml();
?>