<?php

namespace Sphp\Html;
$doc = new Doc();
$html = $doc->insert()->html();
$head = $html->head();
$body = $html->body();

$titleGenerator = new \Sphp\Manual\MVC\TitleGenerator($manualLinks);

$redirect = filter_input(INPUT_SERVER, 'REDIRECT_URL', FILTER_SANITIZE_URL);
$title = $titleGenerator->createTitleFor(trim($redirect, '/'));
$html->setLanguage('en');

use Sphp\Html\Head\Meta;
use Sphp\Html\Head\Link;

$head->set(Meta::charset('UTF-8'));
$head->set(Meta::viewport('width=device-width, initial-scale=1.0'));
$head->setDocumentTitle($title);
//$head->setBaseAddr('http://playground.samiholck.com/', '_self');

$head->set(Link::stylesheet('/sphp/css/sphp.all.css'));
//$head->set(Link::stylesheet('https://cdn.jsdelivr.net/npm/motion-ui@1.2.3/dist/motion-ui.min.css'));
$head->set(Link::stylesheet('https://cdn.rawgit.com/konpa/devicon/master/devicon.min.css'));
$head->set(Link::appleTouchIcon('/apple-touch-icon.png'));
$head->set(Link::icon('/favicon-32x32.png', '32x32'));
$head->set(Link::icon('/favicon-16x16.png', '16x16'));
$head->set(Link::manifest('/site.webmanifest'));
$head->set(Link::maskIcon('/safari-pinned-tab.svg', '#5bbad5'));
$head->set(Meta::namedContent('msapplication-TileColor', '#f1f1f1'));
$head->set(Meta::namedContent('theme-color', '#f1f1f1'));
$head->set(Meta::author('Sami Holck'));
$head->set(Meta::applicationName('SPHPlayground Framework'));
$head->set(Meta::keywords(['php', 'scss', 'css', 'html', 'html5', 'framework',
            'JavaScript', 'DOM', 'Web development', 'tutorials', 'programming',
            'references', 'examples', 'source code', 'demos', 'tips']));
$head->set(Meta::description('SPHP framework for web developement'));

$html->useFontAwesome('9e1f35bc72');
$html->enableSPHP();
if ($redirect === '/Sphp.Html.Media.Multimedia') {
  $html->useVideoJS();
}
$body->addCssClass('manual');
$html->scripts()->appendSrc('/manual/js/formTools.js');
$html->scripts()->appendSrc('/manual/js/techs.js');
$html->scripts()->appendSrc('/sphp/javascript/dist/ss360.min.js');
//$html->scripts()->appendSrc('https://cdn.sitesearch360.com/sitesearch360-v12.mjs');
$html->scripts()->appendSrc('https://cdn.sitesearch360.com/sitesearch360-v12.min.js');
$html->startBody();


