<?php

namespace Sphp\Html;

(new Div("<b>Lorem paragraphs begin</b>"))
        ->ajaxPrepend("manual/snippets/loremipsum.html #lorem_h")->printHtml();
(new Div())
        ->ajaxAppend("manual/snippets/loremipsum.html #par_1")
        ->printHtml();
(new Div("<b>Lorem paragraphs end</b>"))
        ->ajaxPrepend("manual/snippets/loremipsum.html #par_4")->printHtml();

?>