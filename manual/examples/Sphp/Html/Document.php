<?php

namespace Sphp\Html;

use Sphp\Html\Head\Meta;

Document::html("foo")
        ->setLanguage("en");

Document::head("foo")
        ->setDocumentTitle("Foo document")
        ->addCssSrc("print.css", "print")
        ->addCssSrc("screen.css", "screen")
        ->addMeta(Meta::author('Sami Holck'))
        ->addMeta(Meta::applicationName("Foobar"))
        ->addMeta(Meta::keywords("foo", "bar", "foobar"));

Document::body("foo")->append("Welcome to Foo!");
Document::body("foo")->scripts()->appendSrc("foo.js");
Document::body("foo")->scripts()->appendCode("var foo = 2;");

echo Document::html("foo");
