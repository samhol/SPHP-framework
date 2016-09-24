<?php

namespace Sphp\Html;

use Sphp\Core\Configuration;
use Sphp\Net\URL;

include_once("links.php");

Document::setHtmlVersion(Document::HTML5);
$currentUrl = URL::getCurrent();
$pathFinder = new \Sphp\Core\PathFinder();
$title = "SPHP framework";
$conf = Configuration::useDomain("manual");
$conf->paths()->http("manual/pics/favicon.ico");

foreach ($conf->get("PAGE_TITLES") as $linkArr) {
  if ($currentUrl->equals($linkArr["href"])) {
    $title .= ": " . $linkArr["text"];
  }
}
$html = Document::html("manual")->setDocumentTitle($title);
$html->enableSPHP();
$html->head()
        ->useFontAwesome()
        ->useFoundationIcons()
        ->setBaseAddr(Configuration::httpHost(), "_self")
        ->addShortcutIcon($conf->paths()->http("manual/pics/favicon.ico"))
        ->metaTags()
        ->setApplicationName("SPHP")
        ->setAuthor("Sami Holck")
        ->setKeywords("php, scss, css, html, html5, javascript, framework, foundation, jquery")
        ->setDescription("SPHP framework for web developement");
echo $html->getOpeningTag() . $html->head();
?>
