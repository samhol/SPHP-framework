<?php

namespace Sphp\Html;

use Sphp\Http\HttpCodeCollection;
use Sphp\Stdlib\Path;

Document::setHtmlVersion(Document::HTML5);

(new Path())->http('manual/pics/favicon.ico');

$errorCode = filter_input(INPUT_SERVER, 'REDIRECT_STATUS', FILTER_SANITIZE_NUMBER_INT);
if ($errorCode === null) {
  $errorCode = filter_input(INPUT_GET, 'error_code', FILTER_SANITIZE_NUMBER_INT);
}

$html = Document::html();
if ($errorCode !== null) {
  $p = new HttpCodeCollection();
  if ($p->contains($errorCode)) {
    $title = $errorCode . ': ' . $p->getMessage($errorCode);
  }
  Document::html()->setDocumentTitle($title);
  $html->body()->addCssClass('error-page');
} else {
  $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
  $titleGenerator = new \Sphp\Manual\MVC\TitleGenerator($manualLinks);
  $title = $titleGenerator->createTitleFor($page);
  Document::html()->setDocumentTitle($title);
}

use Sphp\Html\Head\Meta;

$html->enableSPHP();
$html->head()
        ->useFontAwesome()
        ->useFoundationIcons()
        ->addCssSrc('https://cdn.rawgit.com/konpa/devicon/master/devicon.min.css')
        ->addCssSrc('//cdn.jsdelivr.net/devicons/1.8.0/css/devicons.min.css')
        ->setBaseAddr(Path::get()->http(), '_self')
        ->addShortcutIcon(Path::get()->http('manual/pics/favicon.ico'))
        ->addMeta(Meta::author('Sami Holck'))
        ->addMeta(Meta::applicationName('SPHP framework'))
        ->addMeta(Meta::keywords('php, scss, css, html, html5, framework, foundation, CSS, JavaScript, DOM, Web development, tutorials, programming, references, examples, source code, demos, tips'))
        ->addMeta(Meta::description('SPHP framework for web developement'));

echo $html->getOpeningTag() . $html->head();
