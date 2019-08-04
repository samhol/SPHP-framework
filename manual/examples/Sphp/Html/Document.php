<?php

namespace Sphp\Html;

use Sphp\Html\Head\Meta;
use Sphp\Html\Head\Link;

$doc = SphpDocument::create();
$doc->setLanguage('en');

$doc->setDocumentTitle('Foo document');
$doc->head()
        ->set(Link::stylesheet('print.css', 'print'))
        ->set(Link::stylesheet('screen.css', 'screen'))
        ->set(Meta::author('Sami Holck'))
        ->set(Meta::applicationName('Foobar'))
        ->set(Meta::keywords('foo', 'bar', 'foobar'));

$doc->body('foo')->append('Welcome to Foo!');
$doc->body('foo')->scripts()->appendSrc('foo.js');
$doc->body('foo')->scripts()->appendCode("var foo = 2;");

echo $doc;
