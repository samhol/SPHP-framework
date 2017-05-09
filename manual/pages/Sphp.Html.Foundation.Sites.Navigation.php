<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Navigation\HyperlinkInterface;

$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
$hyperlinkIfLink = $api->classLinker(HyperlinkInterface::class);
//$namespace = $api->namespaceLink(__NAMESPACE__);
echo $parsedown->text(<<<MD
#FOUNDATION <small>NAVIGATION COMPONENTS</small>
$ns
        
This namespace contains object oriented PHP implementations of Foundation navigation components.

MD
);
//$load('Sphp.Html.Foundation.Sites.Bars');
$load('Sphp.Html.Foundation.Sites.Navigation.DrilldownMenu');

$sideNavClass = $api->classLinker(AccordionMenu::class);
echo $parsedown->text(<<<MD
##The $sideNavClass component

The $sideNavClass component provides navigation for the entire site, or for sections of an individual page.

**Accessibility:** Using the `Tab` button, a user can navigate until
they've reached the link below. (`Shift+Tab` to navigate back one step.)
MD
);
CodeExampleBuilder::visualize('Sphp/Html/Foundation/Sites/Navigation/AccordionMenu.php');

$breadcrumbs = $api->classLinker(BreadCrumbs::class);
$breadcrumb = $api->classLinker(BreadCrumb::class);
echo $parsedown->text(<<<MD
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


$load("Sphp.Html.Foundation.Sites.Navigation.Pagination.php");
