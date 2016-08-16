<?php

namespace Sphp\Html\Foundation\F6\Navigation\Pagination;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
$pagination = $api->classLinker(Pagination::class);
echo $parsedown->text(<<<MD

##The $pagination component
$ns
$pagination is a type of navigation component that lets users tap through a series
of related pages. Moving between pages has become less common with the advent of
longer pages and AJAX loading.
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Navigation/Pagination.php');
