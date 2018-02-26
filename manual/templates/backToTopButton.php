<?php

use Sphp\Html\Apps\BackToTopButton;
use Sphp\Html\Media\Icons\FaIcon;

BackToTopButton::fromIcon((new FaIcon('fas fa-chevron-circle-up'))
        ->setAttribute('title', 'Back to top'))
        ->printHtml();
