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

use Sphp\Html\Foundation\Sites\Buttons\Button;
$b1 = Button::pushButton('example1.js');
$b2 = Button::pushButton('example2.js');
$code1 = Manual\codeModal($b1, 'manual/snippets/example1.js', 'JavaScript example code');
$code2 = Manual\codeModal($b2, 'manual/snippets/example2.js', 'JavaScript example code');
$code1->getTrigger()->addCssClass('button', 'alert');
$code2->getTrigger()->addCssClass('button', 'alert');
$buttonGroup = new \Sphp\Html\Foundation\Sites\Buttons\ButtonGroup();
$buttonGroup->appendButton($b1);
$buttonGroup->appendButton($b2);
Manual\md(<<<MD
#Client-side scripting: <small>JavaScript containers</small>

$ns

Implementations of $scriptInterface are used to define a client-side script, usually JavaScript.
The $scriptCode component contains scripting statements, whereas $scriptFile points to an 
external script file. 
		
**NOTE:** The $noscript element is also available for situations where there 
is no support for client-side scripting.

##$scriptFile component: <small>for external JavaScript files</small>
        
This component points to an external script file. 
$buttonGroup


 **There are several ways an external script can be executed:**

 * If {$scriptFile->methodLink('setAsync', false)}; The script is executed asynchronously with the rest of the page 
  (the script will be executed while the page continues the parsing)
 * If {$scriptFile->methodLink('setDefer', false)};  The script is executed when the page has finished parsing
 * Otherwise the script is fetched and executed immediately, before the browser continues parsing the page

MD
);
echo $code1->getPopup();
echo $code2->getPopup();
Manual\visualize('Sphp/Html/Programming/ScriptInterface.php', 'html5', true);
Manual\md(<<<MD
##$scriptCode component: <small>for script statements</small>

This component contains scripting statements that are to be executed. 
 

MD
);

Manual\visualize('Sphp/Html/Programming/ScriptCode.php', 'html5', true);

Manual\md(<<<MD
##$scriptsContainer component: <small>a $scriptInterface component container</small>
MD
);

Manual\visualize('Sphp/Html/Programming/ScriptsContainer.php', 'html5', true);
