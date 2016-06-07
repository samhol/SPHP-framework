<?php

namespace Sphp\Html;

use Sphp\Core\Configuration as Configuration;
use Sphp\Net\URL as URL;

include_once("links.php");

Document::setHtmlVersion(Document::HTML5);
$currentUrl = URL::getCurrent();
$title = "SPHP framework";
//echo "<pre>";
foreach (Configuration::useDomain("manual")->get("PAGE_TITLES") as $linkArr) {
  if ($currentUrl->equals($linkArr["href"])) {
    $title .= ": " . $linkArr["text"];
  }
}
$html = Document::html("manual")->setTitle($title);
$html->enableSPHP();
$html->head()
        ->useFontAwesome()
        ->useFoundationIcons()
        ->setBaseAddr(Configuration::httpHost(), "_self")
        ->addShortcutIcon("favicon.ico")
        ->metaTags()
        ->setApplicationName("SPHP")
        ->setAuthor("Sami Holck")
        ->setKeywords("php scss css html html5 javascript framework foundation jquery")
        ->setDescription("SPHP framework for web developement");
echo $html->getOpeningTag() . $html->head();

?>
