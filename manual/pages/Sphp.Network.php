<?php

namespace Sphp\Network;

use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
# Network

$ns
  
Framework provides some additional networking functionality to PHP environment. 
  
MD
);

echo '<pre>';
//var_dump(headers_list ());
echo '</pre>';

include 'manual/pages/intros/Network/tabs.php';

Manual\printPage('Sphp.Network.URL.php');


Manual\md(<<<MD
## References {#network_references}        

* http://php.net/manual/en/book.network.php
* https://en.wikipedia.org/wiki/HTTP_cookie
MD
);
