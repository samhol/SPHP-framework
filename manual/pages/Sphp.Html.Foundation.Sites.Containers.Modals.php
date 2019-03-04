<?php

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Manual;

$modal = Manual\api()->classLinker(Modal::class);
Manual\md(<<<MD
### The $modal component

Modal dialogs, or pop-up windows, are handy for prototyping and production.

MD
);
Manual\visualize('Sphp/Html/Foundation/Sites/Containers/Modals/Modal.php', null, true);
