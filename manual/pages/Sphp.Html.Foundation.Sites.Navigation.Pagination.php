<?php

namespace Sphp\Html\Foundation\Sites\Navigation\Pagination;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$pagination = \Sphp\Manual\api()->classLinker(Pagination::class);
\Sphp\Manual\parseDown(<<<MD

##The $pagination component
$ns
$pagination is a type of navigation component that lets users tap through a series
of related pages. Moving between pages has become less common with the advent of
longer pages and AJAX loading.
MD
);
CodeExampleBuilder::visualize('Sphp/Html/Foundation/Sites/Navigation/Pagination.php');
