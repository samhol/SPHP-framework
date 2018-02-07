<?php

namespace Sphp\Html\Foundation\Sites\Navigation\Pagination;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$pagination = \Sphp\Manual\api()->classLinker(Pagination::class);
\Sphp\Manual\md(<<<MD

##The $pagination component
$ns
$pagination is a type of navigation component that lets users tap through a series
of related pages. Moving between pages has become less common with the advent of
longer pages and AJAX loading.
MD
);
\Sphp\Manual\visualize('Sphp/Html/Foundation/Sites/Navigation/Pagination.php');
