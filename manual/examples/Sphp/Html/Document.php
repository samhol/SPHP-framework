<?php

namespace Sphp\Html;

use Sphp\Html\Head\Meta;
use Sphp\Html\Head\Link;

Document::html('foo')
        ->setLanguage('en');

Document::head('foo')
        ->setDocumentTitle('Foo document');
Document::head('foo')
        ->set(Link::stylesheet('print.css', 'print'))
        ->set(Link::stylesheet('screen.css', 'screen'))
        ->set(Meta::author('Sami Holck'))
        ->set(Meta::applicationName('Foobar'))
        ->set(Meta::keywords('foo', 'bar', 'foobar'));

Document::body('foo')->append('Welcome to Foo!');
Document::body('foo')->scripts()->appendSrc('foo.js');
Document::body('foo')->scripts()->appendCode("var foo = 2;");

echo Document::html('foo');
