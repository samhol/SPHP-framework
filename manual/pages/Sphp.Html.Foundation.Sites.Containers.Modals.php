<?php

namespace Sphp\Html\Foundation\Sites\Containers\Modals;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$modal = $api->classLinker(Modal::class);
$controller = $api->classLinker(Controller::class);
$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
##The $modal component
$ns
Modal dialogs, or pop-up windows, are handy for prototyping and production.

MD
);
CodeExampleBuilder::visualize('Sphp/Html/Foundation/F6/Containers/Modals/Modal.php', false, true);
