<?php

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Manual;

$media = Manual\api()->classLinker(Media::class);

Manual\md(<<<MD

##The $media factory <small>for Foundation Badges and labels</small>

The $media factory creates following Foundation components:
 * Badge is a basic component that displays a number. It's useful for calling out a number of unread items.
 * Label is a basic component that displays a number. It's useful for calling out a number of unread items.
MD
);

Manual\example('Sphp/Html/Foundation/Sites/Media/Media-badge.php', null, true)
        ->setExamplePaneTitle('An Example of Foundation Badges')
        ->printHtml();
Manual\example('Sphp/Html/Foundation/Sites/Media/Media-label.php', null, true)
        ->setExamplePaneTitle('An Example of Foundation Labels')
        ->printHtml();
