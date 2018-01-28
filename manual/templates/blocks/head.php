<?php

namespace Sphp\Html;

use Sphp\Stdlib\Path;

$html = Document::html();

$titleGenerator = new \Sphp\Manual\MVC\TitleGenerator($manualLinks);

//echo '<pre>';
//echo \Sphp\MVC\Router::getCleanUrl();
$redirect = filter_input(INPUT_SERVER, 'REDIRECT_URL', FILTER_SANITIZE_URL);
$title = $titleGenerator->createTitleFor(trim($redirect, '/'));
Document::html()->setLanguage('en')->setDocumentTitle($title);

use Sphp\Html\Head\Meta;

$html->enableSPHP();
Document::head()
        ->useFontAwesome()
        //->useFoundationIcons()
        ->addCssSrc('https://cdn.rawgit.com/konpa/devicon/master/devicon.min.css')
        ->addCssSrc('//cdn.jsdelivr.net/devicons/1.8.0/css/devicons.min.css')
        ->setBaseAddr(Path::get()->http(), '_self')
        ->addShortcutIcon('http://playground.samiholck.com/manual/pics/S-logo.png?v=2')
        ->addMeta(Meta::author('Sami Holck'))
        ->addMeta(Meta::applicationName('SPHP framework'))
        ->addMeta(Meta::keywords([
                    'php',
                    'scss',
                    'css',
                    'html',
                    'html5',
                    'framework',
                    'foundation',
                    'JavaScript',
                    'DOM',
                    'Web development',
                    'tutorials',
                    'programming',
                    'references',
                    'examples',
                    'source code',
                    'demos',
                    'tips']))
        ->addMeta(Meta::description('SPHP framework for web developement'));
Document::body()->addCssClass('manual');
Document::html()->scripts()->appendSrc('manual/js/formTools.js');
//Document::html()->scripts()->appendSrc('sphp/javascript/app/sphp/anytime.js');
Document::html()->scripts()->appendSrc('manual/js/ss360Config.js');
Document::html()->scripts()->appendSrc('https://sitesearch360.com/cdn/sitesearch360-v9.min.js');
Document::html()->startBody();


