<?php

namespace Sphp\Html\Foundation\F6\Navigation;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;
use Sphp\Html\Navigation\HyperlinkInterface as HyperlinkInterface;

$ns = $api->getNamespaceBreadGrumbs(__NAMESPACE__);
$hyperlinkIfLink = $api->getClassLink(HyperlinkInterface::class);
//$namespace = $api->getNamespaceLink(__NAMESPACE__);
echo $parsedown->text(<<<MD
#FOUNDATION 6 NAVIGATION COMPONENTS
$ns
        
This namespace contains object oriented PHP implementations of Foundation navigation components.

MD
);
$load("Sphp.Html.Foundation.F6.Navigation.TopBar.php");

$load("Sphp.Html.Foundation.F6.Navigation.OffCanvas.php");

$sideNavClass = $api->getClassLink(AccordionMenu::class);
echo $parsedown->text(<<<MD
##The $sideNavClass component

The $sideNavClass component provides navigation for the entire site, or for sections of an individual page.

**Accessibility:** Using the `Tab` button, a user can navigate until
they've reached the link below. (`Shift+Tab` to navigate back one step.)
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Navigation/AccordionMenu.php');

$breadcrumbs = $api->getClassLink(BreadCrumbs::class);
$breadcrumb = $api->getClassLink(BreadCrumb::class);
echo $parsedown->text(<<<MD
##The $breadcrumbs container for $breadcrumb components

In general the graphical control element Breadcrumbs or breadcrumb trail is a navigation
aid used in user interfaces. It allows users to keep track of their locations within
programs or documents <span class="label">from Wikipedia</span>.

The $breadcrumbs component is a container for individual $breadcrumb components whereas
A $breadcrumb is basically just an implementation of $hyperlinkIfLink.

A $breadcrumbs shows a horizontal navigation trail of individual $breadcrumb components
for users clicking through a site or app. $breadcrumbs component will fill out `100%`
of the width of its parent container.
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Navigation/BreadCrumbs.php');


$load("Sphp.Html.Foundation.F6.Navigation.Pagination.php");