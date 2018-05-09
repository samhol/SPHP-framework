<?php

namespace Sphp\Html\Apps;

use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
#Miscellaneous HTML components and applications
        
$ns
MD
);

Manual\printPage('Sphp.Html.Apps.SyntaxHighlighter');
Manual\printPage('Sphp.Html.Apps.SearchForms');
Manual\printPage('Sphp.Html.Apps.PhotoAlbum');
/*

\Sphp\Manual\visualize('Sphp/Html/Apps/Manual/LinkerInterface.php');

\Sphp\Manual\visualize('Sphp/Html/Apps/misc.php');
\Sphp\Manual\visualize('Sphp/Html/Apps/SyntaxHighlighter.php');
*/
