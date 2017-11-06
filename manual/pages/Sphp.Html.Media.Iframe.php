<?php

namespace Sphp\Html\Media;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$iframe = \Sphp\Manual\api()->classLinker(Iframe::class);
$iframeTag = Apis::w3schools()->tag('iframe');
\Sphp\Manual\parseDown(<<<MD
##The $iframe component 
		
The $iframe class models the HTML $iframeTag tag (HTML inline frame).
$iframe embeds a document into an HTML document 
so that embedded data is displayed inside a subwindow of the browser's window. 
This does not mean full inclusion; the two documents are independent, and both 
them are treated as complete documents.
MD
);

CodeExampleBuilder::visualize("Sphp/Html/Media/Iframe.php", FALSE);
