<?php

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Manual;

$modal = Manual\api()->classLinker(Modal::class);
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
Manual\parseDown(<<<MD
##The $modal component
$ns
Modal dialogs, or pop-up windows, are handy for prototyping and production.

MD
);
Manual\visualize('Sphp/Html/Foundation/Sites/Containers/Modals/Modal.php', null, true);
