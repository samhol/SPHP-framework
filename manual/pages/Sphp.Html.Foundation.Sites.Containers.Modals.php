<?php

namespace Sphp\Html\Foundation\Sites\Containers\Modals;
use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$modal = $api->classLinker(Modal::class);
$controller = $api->classLinker(Controller::class);
$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
##The $modal component
$ns
Modal dialogs, or pop-up windows, are handy for prototyping and production.

MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Containers/Modals/Modal.php', false, true);