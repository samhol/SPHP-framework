<?php

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$modal = \Sphp\Manual\api()->classLinker(Modal::class);
$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
\Sphp\Manual\parseDown(<<<MD
##The $modal component
$ns
Modal dialogs, or pop-up windows, are handy for prototyping and production.

MD
);
CodeExampleBuilder::visualize('Sphp/Html/Foundation/Sites/Containers/Modals/Modal.php', false, true);
