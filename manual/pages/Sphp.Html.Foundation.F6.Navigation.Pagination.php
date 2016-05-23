<?php

namespace Sphp\Html\Foundation\F6\Navigation\Pagination;

$namespace = $api->getNamespaceLink(__NAMESPACE__, FALSE);
$pagination = $api->getClassLink(Pagination::class);
echo $parsedown->text(<<<MD

##The $namespace sub namespace for $pagination component

$pagination is a type of navigation component that lets users tap through a series
of related pages. Moving between pages has become less common with the advent of
longer pages and AJAX loading.
MD
);
$exampleViewer(EXAMPLE_DIR . 'Sphp/Html/Foundation/Navigation/Pagination.php', 2);