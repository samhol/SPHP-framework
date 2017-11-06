<?php

namespace Sphp\Html\Media;

use Sphp\Html\Apps\Manual\Apis;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

\Sphp\Manual\parseDown(<<<MD
#HTML MEDIA: <small>images, sound, music, videos, movies, and animations</small>
$ns

MD
);
\Sphp\Manual\loadPage('Sphp.Html.Media.SizeableInterface-LazyLoaderInterface');
\Sphp\Manual\loadPage('Sphp.Html.Media.Img');
\Sphp\Manual\loadPage('Sphp.Html.Media.ImgMap');
\Sphp\Manual\loadPage('Sphp.Html.Media.Iframe');
//\Sphp\Manual\loadPage("Sphp.Html.Media.AV.VideoPlayerInterface.php");
//\Sphp\Manual\loadPage("Sphp.Html.Media.AV.VideoJs.php");
//\Sphp\Manual\loadPage("Sphp.Html.Media.AV.Video.php");
