<?php

namespace Sphp\Html;

use Sphp\Html\Head\MetaTag;

Document::html("foo")
        ->setLanguage("en");

Document::head("foo")
        ->setDocumentTitle("Foo document")
        ->addCssSrc("print.css", "print")
        ->addCssSrc("screen.css", "screen")
        ->addMeta(MetaTag::author('Sami Holck'))
        ->addMeta(MetaTag::applicationName("Foobar"))
        ->addMeta(MetaTag::keywords("foo", "bar", "foobar"));

Document::body("foo")->append("Welcome to Foo!");
Document::body("foo")->scripts()->appendSrc("foo.js");
Document::body("foo")->scripts()->appendCode("var foo = 2;");

echo Document::html("foo");
