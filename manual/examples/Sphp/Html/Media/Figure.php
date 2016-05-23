<?php

namespace Sphp\Html\Media;

(new Figure("http://sphp.samiholck.com/sphpManual/photos/spacewalk.jpg"))
        ->printHtml();

(new Figure("http://sphp.samiholck.com/sphpManual/photos/spacewalk.jpg", "A spacewalk"))
        ->printHtml();
?> 