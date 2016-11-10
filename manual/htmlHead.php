<?php

namespace Sphp\Html;

use Sphp\Core\Configuration;
use Sphp\Core\Types\URL;

include_once('links.php');

Document::setHtmlVersion(Document::HTML5);
$currentUrl = URL::getCurrent();
$title = 'SPHP framework';
$conf = Configuration::useDomain('manual');
$conf->paths()->http('manual/pics/favicon.ico');

foreach ($conf->get('PAGE_TITLES') as $linkArr) {
  if ($currentUrl->equals($linkArr['href'])) {
    $title .= ': ' . $linkArr['text'];
  }
}
$html = Document::html("manual")->setDocumentTitle($title);
$html->enableSPHP();
$html->head()
        ->useFontAwesome()
        ->useFoundationIcons()
        ->setBaseAddr($conf->paths()->http(), '_self')
        ->addShortcutIcon($conf->paths()->http('manual/pics/favicon.ico'))
        ->metaTags()
        ->setApplicationName('SPHP')
        ->setAuthor('Sami Holck')
        ->setKeywords('php, scss, css, html, html5, javascript, framework, foundation, jquery')
        ->setDescription('SPHP framework for web developement');
echo $html->getOpeningTag() . $html->head();
