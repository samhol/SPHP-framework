<?php

namespace Sphp\Html\Media;
use Sphp\Manual;
$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
#HTML MEDIA: <small>images, sound, music, videos, movies, and animations</small>
$ns

MD
);
Manual\loadPage('Sphp.Html.Media.SizeableInterface-LazyLoaderInterface');
Manual\loadPage('Sphp.Html.Media.Img');
Manual\loadPage('Sphp.Html.Media.ImgMap');
Manual\loadPage('Sphp.Html.Media.Iframe');
//\Sphp\Manual\loadPage("Sphp.Html.Media.AV.VideoPlayerInterface.php");
//\Sphp\Manual\loadPage("Sphp.Html.Media.AV.VideoJs.php");
//\Sphp\Manual\loadPage("Sphp.Html.Media.AV.Video.php");
