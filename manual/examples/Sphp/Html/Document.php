<?php

namespace Sphp\Html;

use Sphp\Html\Head\Meta;

$fooDoc = Document::html("foo");

Document::html("foo")->setDocumentTitle("Foo document");
Document::html("foo")->head()
        ->enableSPHP()
        ->useFontAwesome()
        ->addMeta(Meta::author('Sami Holck'))
        ->addMeta(Meta::applicationName('SPHP framework'))
        ->addMeta(Meta::keywords(
                        ['php', 'scss', 'css', 'html', 'html5', 'javascript', 'jquery']));
Document::html("foo")->body()->append("Hello Foo!");
Document::html("foo")->printHtml();
