<?php

namespace Sphp\Html\Media;

(new Figure("http://playground.samiholck.com/manual/photos/spacewalk.jpg"))
        ->setLazy()
        ->printHtml();

(new Figure("http://playground.samiholck.com/manual/photos/spacewalk.jpg", "A spacewalk"))
        ->setLazy()
        ->printHtml();
?> 