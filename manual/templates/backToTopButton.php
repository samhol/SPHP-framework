<?php

use Sphp\Html\Apps\BackToTopButton;
use Sphp\Html\Media\Icons\Icons;

BackToTopButton::fromIcon(Icons::fontAwesome('fa-chevron-circle-up')
        ->setAttribute('title', 'Back to top'))
        ->printHtml();
