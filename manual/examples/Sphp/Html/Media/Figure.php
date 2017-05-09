<?php

namespace Sphp\Html\Media;

(new Figure("manual/photos/spacewalk.jpg"))
        ->setLazy()
        ->printHtml();

$fig2 = (new Figure("manual/photos/spacewalk.jpg", "A spacewalk"));
        $fig2->setLazy()
        ->printHtml();
?> 