<?php

namespace Sphp\Html;

use Sphp\Html\Head\MetaTag;

Document::html("foo")
        ->setLanguage("en");

Document::head("foo")
        ->setDocumentTitle("Foo document")
        ->setCssSrc("print.css", "print")
        ->setCssSrc("screen.css", "screen")
        ->set(MetaTag::author('Sami Holck'))
        ->set(MetaTag::applicationName("Foobar"))
        ->set(MetaTag::keywords("foo", "bar", "foobar"));

Document::body("foo")->append("Welcome to Foo!");
Document::body("foo")->scripts()->appendSrc("foo.js");
Document::body("foo")->scripts()->appendCode("var foo = 2;");

echo Document::html("foo");
