<?php

use Sphp\Html\Apps\BackToTopButton;
use Sphp\Html\Media\Icons\FontAwesomeIcon;

BackToTopButton::fromIcon((new FontAwesomeIcon('fas fa-chevron-circle-up'))
        ->setAttribute('title', 'Back to top'))
        ->printHtml();
