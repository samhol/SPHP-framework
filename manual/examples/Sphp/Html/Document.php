<?php

namespace Sphp\Html;

$fooDoc = Document::html("foo");


Document::html("foo")->setTitle("Foo document");
Document::html("foo")->head()
        ->enableSPHP()
        ->useFontAwesome()
        ->metaTags()
          ->setApplicationName("Foo app")
          ->setKeywords("foo bar foobar");
Document::html("foo")->body()->append("Hello Foo!");
Document::html("foo")->printHtml();
