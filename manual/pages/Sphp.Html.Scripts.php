<?php

namespace Sphp\Html\Scripts;

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
$code1 = Manual\codeModal('example1.js', 'manual/snippets/example1.js', 'JavaScript example code');
$code2 = Manual\codeModal('example2.js', 'manual/snippets/example2.js', 'JavaScript example code');
$tr1 = $code1->getTrigger()->addCssClass('button', 'alert');
$tr2 = $code2->getTrigger()->addCssClass('button', 'alert');
$buttonGroup = new \Sphp\Html\Foundation\Sites\Buttons\ButtonGroup();
$buttonGroup->appendButton($b1);
$buttonGroup->appendButton($b2);
Manual\md(<<<MD
## Client-side scripting <small>using JavaScript containers</small>{#js-h1}

$ns

 $scriptInterface interface defines an HTML element for client-side scripting, usually JavaScript.

 * $scriptsContainer class implements a container for $scriptInterface components
   * $scriptCode class implements an HTML element that contains client-side scripting statements
   * $scriptFile class implements an HTML element that points to an external script file 
 * $noscript class implements an HTML element for situations where there is no support for client-side scripting

**NOTE!:**
The best practice of placing client side scripts is usually the end of the page, just inside the closing body tag. 
This guarantees that all of the DOM elements needed are already present on the page. 
        
<div class="button-group">
$tr1
$tr2
</div>


MD
);

echo $code1->getPopup();
echo $code2->getPopup();

Manual\visualize('Sphp/Html/Scripts/ScriptsContainer.php', 'html5', true);

