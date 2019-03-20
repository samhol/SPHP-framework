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

include 'manual/pages/intros/Network/tabs.php';

Manual\printPage('Sphp.Network.URL.php');


Manual\md(<<<MD
https://caniuse.com/
MD
);
