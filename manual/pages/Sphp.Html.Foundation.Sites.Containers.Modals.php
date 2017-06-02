<?php

namespace Sphp\Html\Foundation\Sites\Containers;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$modal = $api->classLinker(Modal::class);
$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
##The $modal component
$ns
Modal dialogs, or pop-up windows, are handy for prototyping and production.

MD
);
CodeExampleBuilder::visualize('Sphp/Html/Foundation/Sites/Containers/Modals/Modal.php', false, true);
