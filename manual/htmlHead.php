<?php

namespace Sphp\Html;

use Sphp\Core\Configuration as Configuration;
use Sphp\Net\URL as URL;

include_once("links.php");

Doc::setHtmlVersion(Doc::HTML5);
$currentUrl = URL::getCurrent();
$title = "SPHP framework";
//echo "<pre>";
foreach (Configuration::useDomain("manual")->get("PAGE_TITLES") as $linkArr) {
  if ($currentUrl->equals($linkArr["href"])) {
    $title .= ": " . $linkArr["text"];
  }
  else {
    //$title = $linkArr["href"];
  }
}
$html = new Html($title);
$html->head()
        /*->addCssSrc("http://fonts.googleapis.com/css?family="
                . "Source+Sans+Pro:400,600,700,400italic,600italic,700italic%7c"
                . "Source+Code+Pro:400,500,600,700%7c"
                . "Open+Sans:400italic,600italic,700italic,400,700,600")*/
        ->enableSPHP()
        ->useFontAwesome()
        ->useFoundationIcons()
        ->setBaseAddr(Configuration::httpHost(), "_self")
        //->addCssSrc("sphp/css/manual.css")
        ->addShortcutIcon("favicon.ico")
        ->metaTags()
        ->setApplicationName("SPHP")
        ->setAuthor("Sami Holck")
        ->setKeywords("php scss css html html5 javascript framework foundation jquery")
        ->setDescription("SPHP framework for web developement");
echo $html->getOpeningTag() . $html->head();

$sphpScripts = new Programming\SphpScriptsLoader();
$sphpScripts->appendSPHP();
$html->scripts($sphpScripts);
?>
