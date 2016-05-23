<?php

namespace Sphp\Html\Foundation\Navigation;

use Sphp\Html\Navigation\HyperlinkInterface as HyperlinkInterface;

$hyperlinkIfLink = $api->getClassLink(HyperlinkInterface::class);
$namespace = $api->getNamespaceLink(__NAMESPACE__);
echo $parsedown->text(<<<MD
#FOUNDATION NAVIGATION COMPONENTS

$namespace namespace contains object oriented PHP implementations of Foundation navigation components.

MD
);
$load("Sphp.Html.Foundation.Navigation.TopBar.php");

$load("Sphp.Html.Foundation.Navigation.OffCanvas.php");

$sideNavClass = $api->getClassLink(SideNav\SideNav::class);
echo $parsedown->text(<<<MD
##The $sideNavClass component

The $sideNavClass component provides navigation for the entire site, or for sections of an individual page.

**Accessibility:** Using the `Tab` button, a user can navigate until
they've reached the link below. (`Shift+Tab` to navigate back one step.)
MD
);
$exampleViewer(EXAMPLE_DIR . 'Sphp/Html/Foundation/Navigation/SideNav.php', 2);

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
$exampleViewer(EXAMPLE_DIR . 'Sphp/Html/Foundation/Navigation/BreadCrumbs.php', 2);

$load("Sphp.Html.Foundation.Navigation.SubNav.php");

$load("Sphp.Html.Foundation.Navigation.Pagination.php");