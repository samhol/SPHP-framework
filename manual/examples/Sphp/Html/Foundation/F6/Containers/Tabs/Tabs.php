<?php

namespace Sphp\Html\Foundation\F6\Containers\Tabs;

use Sphp\Html\Div as Div;
use Sphp\Html\Sections\Paragraph as Paragraph;

(new Tabs())->addTab("1st. tab", (new Div())
                ->ajaxAppend("manual/snippets/loremipsum.html"))
        ->addTab("2nd. Tab", (new Paragraph())
                ->ajaxAppend("manual/snippets/loremipsum.html #par_1"))
        ->addTab("3rd. Tab", (new Paragraph())
                ->ajaxAppend("manual/snippets/loremipsum.html #par_2"))
        ->addTab("4th. Tab", (new Paragraph())
                ->ajaxAppend("manual/snippets/loremipsum.html #par_3"))
        ->printHtml();
?>
