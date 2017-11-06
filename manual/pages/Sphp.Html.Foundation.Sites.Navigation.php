<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Navigation\HyperlinkInterface;
use Sphp\Html\Apps\Manual\Apis;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$hyperlinkIfLink = \Sphp\Manual\api()->classLinker(HyperlinkInterface::class);
//$namespace = $api->namespaceLink(__NAMESPACE__);
\Sphp\Manual\parseDown(<<<MD
#FOUNDATION <small>NAVIGATION COMPONENTS</small>
$ns
        
This namespace contains object oriented PHP implementations of Foundation navigation components.

MD
);
//\Sphp\Manual\loadPage('Sphp.Html.Foundation.Sites.Bars');
\Sphp\Manual\loadPage('Sphp.Html.Foundation.Sites.Navigation.DrilldownMenu');

$sideNavClass = \Sphp\Manual\api()->classLinker(AccordionMenu::class);
\Sphp\Manual\parseDown(<<<MD
##The $sideNavClass component

The $sideNavClass component provides navigation for the entire site, or for sections of an individual page.

**Accessibility:** Using the `Tab` button, a user can navigate until
they've reached the link below. (`Shift+Tab` to navigate back one step.)
MD
);
CodeExampleBuilder::visualize('Sphp/Html/Foundation/Sites/Navigation/AccordionMenu.php');

$breadcrumbs = \Sphp\Manual\api()->classLinker(BreadCrumbs::class);
$breadcrumb = \Sphp\Manual\api()->classLinker(BreadCrumb::class);
\Sphp\Manual\parseDown(<<<MD
##The $breadcrumbs container for $breadcrumb components

In general the graphical control element Breadcrumbs or breadcrumb trail is a navigation
aid used in user interfaces. It allows users to keep track of their locations within
programs or documents <span class="label">from Wikipedia</span>.

The $breadcrumbs component is a container for individual $breadcrumb components whereas
A $breadcrumb is basically just an implementation of $hyperlinkIfLink.

A $breadcrumbs instance shows a horizontal navigation trail of individual $breadcrumb components. 
Thi component will fill out `100%` of the width of its parent container.
MD
);
CodeExampleBuilder::visualize('Sphp/Html/Foundation/Sites/Navigation/BreadCrumbs.php');


\Sphp\Manual\loadPage("Sphp.Html.Foundation.Sites.Navigation.Pagination.php");
