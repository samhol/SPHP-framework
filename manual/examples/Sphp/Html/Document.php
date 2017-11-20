<?php

namespace Sphp\Html;

use Sphp\Html\Head\Meta;

$fooDoc = Document::html("foo");

Document::html("foo")->setDocumentTitle("Foo document");
Document::head("foo")
        ->addCssSrc("print.css", "print")
        ->addCssSrc("screen.css", "screen")
        ->addMeta(Meta::author('Sami Holck'))
        ->addMeta(Meta::applicationName('Foobar'))
        ->addMeta(Meta::keywords(
                        ['foo', 'bar', 'foobar']));
Document::body("foo")->append("Welcome to Foo!")->scripts()
        ->appendSrc('foo.js')
        ->appendCode('var foo = 2');
echo Document::html("foo");
