<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Html\Navigation\Hyperlink;
use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$hyperlinkIfLink = Manual\api()->classLinker(Hyperlink::class);
//$namespace = $api->namespaceLink(__NAMESPACE__);
Manual\md(<<<MD
#Foundation <small>navigation components</small>
$ns

This namespace contains object oriented PHP implementations of Foundation navigation components. 

MD
);

Manual\printPage('Sphp.Html.Foundation.Sites.Navigation.Menu');
Manual\printPage('Sphp.Html.Foundation.Sites.Navigation.Bars');
$breadcrumbs = Manual\api()->classLinker(BreadCrumbs::class);
$breadcrumb = Manual\api()->classLinker(BreadCrumb::class);
Manual\md(<<<MD
##The $breadcrumbs container for $breadcrumb components

In general the graphical control element Breadcrumbs or breadcrumb trail is a navigation
aid used in user interfaces. It allows users to keep track of their locations within
programs or documents <span class="label">from Wikipedia</span>.
        
The graphical control element {@link self} is a navigation aid used in user 
interfaces. It allows users to keep track of their locations within programs or documents.

This component shows a navigation trail for users clicking through a 
site or app. They'll fill out 100% of the width of their parent container.
        
The $breadcrumbs component is a container for individual $breadcrumb components whereas
A $breadcrumb is basically just an implementation of $hyperlinkIfLink.

A $breadcrumbs instance shows a horizontal navigation trail of individual $breadcrumb components. 
Thi component will fill out `100%` of the width of its parent container.
MD
);
Manual\example('Sphp/Html/Foundation/Sites/Navigation/BreadCrumbs.php')->printHtml();


Manual\printPage('Sphp.Html.Foundation.Sites.Navigation.Pagination');
