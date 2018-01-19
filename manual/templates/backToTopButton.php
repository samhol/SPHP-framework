<?php

namespace Sphp\Html\Apps;

use Sphp\Html\Icons\Icons;

BackToTopButton::fromIcon(Icons::fontAwesome('fa-chevron-circle-up')
        ->setAttr('title', 'Back to top'))
        ->printHtml();
