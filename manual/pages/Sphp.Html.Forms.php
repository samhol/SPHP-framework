<?php

namespace Sphp\Html\Forms;

use Sphp\Html\Forms\Inputs\TextualInput as TextualInput;
use Sphp\Html\Forms\Inputs\Checkbox as Checkbox;
use Sphp\Html\Forms\Inputs\Radiobox as Radiobox;
use Sphp\Html\Forms\Inputs\InputInterface as InputInterface;

$formIfLink = $api->classLinker(FormInterface::class);
$traversableFormInterface = $api->classLinker(TraversableFormInterface::class);
$inputInterface = $api->classLinker(InputInterface::class);
$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);

echo $parsedown->text(<<<MD
#HTML FORMS
$ns
HTML form objects implement atleast either $formIfLink or  $traversableFormInterface interface. 
These Form objects are used to pass user input data to a server.

        
$formIfLink gives athe basic requirements for any form implementation. Whereas $traversableFormInterface 
extending $formIfLink is a container for $inputInterface components like ({$api->classLinker(TextualInput::class)},
{$api->classLinker(Checkbox::class)}, {$api->classLinker(Radiobox::class)}, submit buttons and more.
A form can also contain select lists, textarea, fieldset, legend, and label elements.

MD
);
$load("Sphp.Html.Forms.InputInterface.php");

