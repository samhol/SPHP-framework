<?php

namespace Sphp\Html\Programming;

$script1 = new ScriptSrc("manual/snippets/example1.js");
$script2 = new ScriptSrc("manual/snippets/example2.js");
$script3 = new ScriptCode('alertUser($user);');
$scriptsContainer = new ScriptsContainer();

$scriptsContainer->append($script1);
$scriptsContainer->appendSrc("manual/snippets/example2.js");
$scriptsContainer->appendCode('document.write(\'<button class="button" type="button" onclick="alertUser($user)">ALERT!</button>\')');
$scriptsContainer->printHtml();
