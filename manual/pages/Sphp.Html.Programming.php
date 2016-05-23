<?php

namespace Sphp\Html\Programming;

$scriptInterface = $api->getClassLink(ScriptInterface::class);
$scriptCode = $api->getClassLink(ScriptCode::class);
$scriptFile = $api->getClassLink(ScriptSrc::class);
$scriptsContainer = $api->getClassLink(ScriptsContainer::class);
$noscript = $api->getClassLink(Noscript::class);
$ns = $api->getNamespaceBreadGrumbs(__NAMESPACE__);

echo $parsedown->text(<<<MD
##HTML CLIENT SIDE SCRIPTING

$ns

 Implementations of $scriptInterface are used to define a client-side script, usually JavaScript.
The $scriptCode component contains scripting statements, whereas $scriptFile points to an 
external script file through the `src` attribute. Common uses for JavaScript are for example
image manipulation, form validation, and dynamic changes of HTML content.
		
**NOTE:** The $noscript element is also available for situations where there 
is no support for client-side scripting.
		
###Pointing to External JavaScript files with $scriptFile component
		
Note: There are several ways an external script can be executed:

* If async="async": The script is executed asynchronously with the rest of the page 
  (the script will be executed while the page continues the parsing)
* If async is not present and defer="defer": The script is executed when the page 
  has finished parsing
* If neither async or defer is present: The script is fetched and executed immediately, 
  before the browser continues parsing the page
        

###Setting script statements with $scriptCode component
$scriptCode component containing statements can be manipulated several ways. 
  
 1. via {$php->getClassLink(\ArrayAccess::class)}

MD
);
$exampleViewer(EXAMPLE_DIR . "Sphp/Html/Programming/ScriptInterface.php", "html5", true);
echo $parsedown->text(<<<MD
###$scriptsContainer component for client side script loading
MD
);
$exampleViewer(EXAMPLE_DIR . "Sphp/Html/Programming/ScriptsContainer.php", "html5", true);
