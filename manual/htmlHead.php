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

$errorCode = filter_input(INPUT_SERVER, 'REDIRECT_STATUS', FILTER_SANITIZE_NUMBER_INT);
if ($errorCode === null) {
  $errorCode = filter_input(INPUT_GET, 'error_code', FILTER_SANITIZE_NUMBER_INT);
}

//use Sphp\Core\Util\FileUtils;
use Sphp\Core\Http\HttpCodeCollection;

$html = Document::html();
if ($errorCode !== null) {
  $p = new HttpCodeCollection();
  //echo '<pre>';
  //echo "\n" . $errorCode . "\n";
  //$err = FileUtils::parseYaml(__DIR__ . '/error_docs/http_errors.yaml');
  //print_r($err = FileUtils::parseYaml(__DIR__ . '/error_docs/http_errors.yaml'));
  if ($p->contains($errorCode)) {
    $title = $errorCode . ': ' . $p->getMessage($errorCode);
  }
  Document::html()->setDocumentTitle($title);
  $html->body()->addCssClass('error-page');
  //echo '</pre>';
} else {
  foreach ($conf->get('PAGE_TITLES') as $linkArr) {
    if ($currentUrl->equals($linkArr['href'])) {
      $title .= ': ' . $linkArr['text'];
    }
  }
  Document::html()->setDocumentTitle($title);
}
$html->enableSPHP();
$html->head()
        ->useFontAwesome()
        ->useFoundationIcons()
        ->addCssSrc('https://cdn.rawgit.com/konpa/devicon/master/devicon.min.css')
        ->setBaseAddr($conf->paths()->http(), '_self')
        ->addShortcutIcon($conf->paths()->http('manual/pics/favicon.ico'))
        ->metaTags()
        ->setApplicationName('SPHP')
        ->setAuthor('Sami Holck')
        ->setKeywords('php, scss, css, html, html5, javascript, framework, foundation, jquery')
        ->setDescription('SPHP framework for web developement');

echo $html->getOpeningTag() . $html->head();
