<?php

namespace Sphp\Html\Programming;

use Sphp\Manual;

$scriptInterface = Manual\api()->classLinker(Script::class);
$scriptCode = Manual\api()->classLinker(ScriptCode::class);
$scriptFile = Manual\api()->classLinker(ScriptSrc::class);
$scriptsContainer = Manual\api()->classLinker(ScriptsContainer::class);
$noscript = Manual\api()->classLinker(Noscript::class);
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$arrayAccess = Manual\php()->classLinker(\ArrayAccess::class);

Manual\md(<<<MD
#Client-side scripting: <small>JavaScript containers</small>

$ns

 Implementations of $scriptInterface are used to define a client-side script, usually JavaScript.
The $scriptCode component contains scripting statements, whereas $scriptFile points to an 
external script file. 
		
**NOTE:** The $noscript element is also available for situations where there 
is no support for client-side scripting.
		
##$scriptFile component: <small>for external JavaScript files</small>{#scriptFile}
		
Note: There are several ways an external script can be executed:

* If async="async": The script is executed asynchronously with the rest of the page 
  (the script will be executed while the page continues the parsing)
* If async is not present and defer="defer": The script is executed when the page 
  has finished parsing
* Otherwise the script is fetched and executed immediately, before the browser 
  continues parsing the page
        

##$scriptCode component: <small>for script statements</small>{#scriptCode}
        
$scriptCode component containing statements can be manipulated several ways. 
  
 1. via $arrayAccess

MD
);

Manual\visualize("Sphp/Html/Programming/ScriptInterface.php", "html5", true);

Manual\md(<<<MD
##$scriptsContainer component: <small>a $scriptInterface component container</small>{#scriptsContainer}
MD
);

Manual\visualize("Sphp/Html/Programming/ScriptsContainer.php", "html5", true);
