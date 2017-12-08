<?php

namespace Sphp\Html\Media;

use Sphp\Manual;

$iframe = Manual\api()->classLinker(Iframe::class);
$iframeTag = Manual\w3schools()->tag('iframe');

Manual\md(<<<MD
##The $iframe component 
		
The $iframe class models the HTML $iframeTag tag (HTML inline frame).
$iframe embeds a document into an HTML document 
so that embedded data is displayed inside a subwindow of the browser's window. 
This does not mean full inclusion; the two documents are independent, and both 
them are treated as complete documents.
MD
);

Manual\visualize('Sphp/Html/Media/Iframe.php', null);
