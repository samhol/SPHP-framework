<?php

namespace Sphp\Html\Programming;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$scriptInterface = Apis::sami()->classLinker(ScriptInterface::class);
$scriptCode = Apis::sami()->classLinker(ScriptCode::class);
$scriptFile = Apis::sami()->classLinker(ScriptSrc::class);
$scriptsContainer = Apis::sami()->classLinker(ScriptsContainer::class);
$noscript = Apis::sami()->classLinker(Noscript::class);
$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
$arrayAccess = Apis::phpManual()->classLinker(\ArrayAccess::class);
echo $parsedown->text(<<<MD
#Client-side scripting: <small>JavaScript containers</small>

$ns

 Implementations of $scriptInterface are used to define a client-side script, usually JavaScript.
The $scriptCode component contains scripting statements, whereas $scriptFile points to an 
external script file through the `src` attribute. Common uses for JavaScript are for example
image manipulation, form validation, and dynamic changes of HTML content.
		
**NOTE:** The $noscript element is also available for situations where there 
is no support for client-side scripting.
		
##$scriptFile component: <small>for external JavaScript files</small>{#scriptFile}
		
Note: There are several ways an external script can be executed:

* If async="async": The script is executed asynchronously with the rest of the page 
  (the script will be executed while the page continues the parsing)
* If async is not present and defer="defer": The script is executed when the page 
  has finished parsing
* If neither async or defer is present: The script is fetched and executed immediately, 
  before the browser continues parsing the page
        

##$scriptCode component: <small>for script statements</small>{#scriptCode}
        
$scriptCode component containing statements can be manipulated several ways. 
  
 1. via $arrayAccess

MD
);
CodeExampleBuilder::visualize("Sphp/Html/Programming/ScriptInterface.php", "html5", true);
echo $parsedown->text(<<<MD
##$scriptsContainer component: <small>a $scriptInterface component container</small>{#scriptsContainer}
MD
);
CodeExampleBuilder::visualize("Sphp/Html/Programming/ScriptsContainer.php", "html5", true);
