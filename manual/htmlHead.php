<?php

namespace Sphp\Html;

//use Sphp\Core\Configuration;
use Sphp\Core\Http\HttpCodeCollection;
use Sphp\Core\Util\FileUtils;
use Sphp\Core\Path;

//Configuration::useDomain('manual');

Document::setHtmlVersion(Document::HTML5);
//$currentUrl = URL::getCurrent();
//$title = 'SPHP framework';
//$conf = Configuration::useDomain('manual');
(new Path())->http('manual/pics/favicon.ico');

$errorCode = filter_input(INPUT_SERVER, 'REDIRECT_STATUS', FILTER_SANITIZE_NUMBER_INT);
if ($errorCode === null) {
  $errorCode = filter_input(INPUT_GET, 'error_code', FILTER_SANITIZE_NUMBER_INT);
}

//use Sphp\Core\Util\FileUtils;


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
  $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
  $data = FileUtils::parseYaml(Path::get()->local('manual/yaml/documentation_links.yaml'));
  $titleGenerator = new \Sphp\Manual\MVC\TitleGenerator($data);
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
