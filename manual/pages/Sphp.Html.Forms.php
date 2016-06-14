<?php

namespace Sphp\Html\Forms;

use Sphp\Html\Forms\Input\TextualInput as TextualInput;
use Sphp\Html\Forms\Input\Checkbox as Checkbox;
use Sphp\Html\Forms\Input\Radiobox as Radiobox;
use Sphp\Html\Document as Document;

$formIfLink = $api->getClassLink(FormInterface::class);
$traversableFormInterface = $api->getClassLink(TraversableFormInterface::class);
$inputInterface = $api->getClassLink(InputInterface::class);

Document::html("manual")->scripts()->appendSrc("manual/js/formTools.js");
$ns = $api->getNamespaceBreadGrumbs(__NAMESPACE__);

//(new \Sphp\Html\Programming\ScriptSrc("manual/js/formTools.js"))->printHtml();
echo $parsedown->text(<<<MD
#HTML FORMS
$ns
HTML form objects implement atleast either $formIfLink or  $traversableFormInterface interface. 
These Form objects are used to pass user input data to a server.

        
$formIfLink gives athe basic requirements for any form implementation. Whereas $traversableFormInterface 
extending $formIfLink is a container for $inputInterface components like ({$api->getClassLink(TextualInput::class)},
{$api->getClassLink(Checkbox::class)}, {$api->getClassLink(Radiobox::class)}, submit buttons and more.
A form can also contain select lists, textarea, fieldset, legend, and label elements.

MD
);
$load("Sphp.Html.Forms.InputInterface.php");

