<?php

namespace Sphp\Html;

$html = Document::html();

$titleGenerator = new \Sphp\Manual\MVC\TitleGenerator($manualLinks);

//echo '<pre>';
//echo \Sphp\MVC\Router::getCleanUrl();
$redirect = filter_input(INPUT_SERVER, 'REDIRECT_URL', FILTER_SANITIZE_URL);
$title = $titleGenerator->createTitleFor(trim($redirect, '/'));
Document::html()->setLanguage('en')->setDocumentTitle($title);

use Sphp\Html\Head\Meta;
use Sphp\Html\Head\Link;

$head = Document::head();
$html->body();
$html->enableSPHP()
        ->useVideoJS()
        ->setViewport('width=device-width, initial-scale=1.0')->useFontAwesome();

$head->set(Meta::charset('UTF-8'));
$head->setCssSrc('http://playground.samiholck.com/sphp/css/sphp.all.css');
$head->setCssSrc('https://cdnjs.cloudflare.com/ajax/libs/motion-ui/1.1.1/motion-ui.min.css');
$head->setCssSrc('https://cdn.rawgit.com/konpa/devicon/master/devicon.min.css');
$head->setBaseAddr('http://playground.samiholck.com/', '_self');
$head->setShortcutIcon('http://playground.samiholck.com/manual/pics/S-logo.png');
$head->set(Link::create('/apple-touch-icon.png', 'apple-touch-icon'));
$head->set(Meta::namedContent('msapplication-TileColor', '#f1f1f1'));
$head->set(Meta::namedContent('theme-color', '#f1f1f1'));
$head->set(Meta::author('Sami Holck'));
$head->set(Meta::applicationName('SPHPlayground Framework'));
$head->set(Meta::keywords(['php', 'scss', 'css', 'html', 'html5', 'framework',
            'JavaScript', 'DOM', 'Web development', 'tutorials', 'programming',
            'references', 'examples', 'source code', 'demos', 'tips']));
$head->set(Meta::description('SPHP framework for web developement'));
Document::body()->addCssClass('manual');
Document::html()->scripts()->appendSrc('manual/js/formTools.js');
Document::html()->scripts()->appendSrc('manual/js/techs.js');
Document::html()->scripts()->appendSrc('sphp/javascript/dist/ss360.min.js');
Document::html()->scripts()->appendSrc('https://sitesearch360.com/cdn/sitesearch360-v9.min.js');
Document::html()->startBody();


