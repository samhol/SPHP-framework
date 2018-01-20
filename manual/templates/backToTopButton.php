<?php

namespace Sphp\Html\Apps;

use Sphp\Html\Icons\Icons;

BackToTopButton::fromIcon(Icons::fontAwesome('fa-chevron-circle-up')
        ->setAttribute('title', 'Back to top'))
        ->printHtml();
