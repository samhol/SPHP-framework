<?php

namespace Sphp\MVC;

require_once 'loaders.php';

$router = new Router();
$router->route('/', $loadIndex);
$router->route('/<!category>', $loadPage);
//$router->route('/kilpailut/<*categories>', $loadCompetition);
$router->setDefaultRoute($loadNotFound);

namespace Sphp\Html;

use Sphp\Stdlib\Path;

Document::setHtmlVersion(Document::HTML5);

$html = Document::html();

$titleGenerator = new \Sphp\Manual\MVC\TitleGenerator($manualLinks);
$title = $titleGenerator->createTitleFor(trim($_SERVER["REDIRECT_URL"], '/'));
Document::html()->setLanguage('en')->setDocumentTitle($title);

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
Document::html()->body()->addCssClass('manual');
Document::html()->scripts()->appendSrc('manual/js/formTools.js');
Document::html()->startBody();
