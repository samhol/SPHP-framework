<?php

namespace Sphp\Html\Forms;

use Sphp\Html\Forms\Inputs\InputInterface;
use Sphp\Html\Apps\Manual\Apis;

$formIfLink = Apis::apigen()->classLinker(FormInterface::class);
$traversableFormInterface = Apis::apigen()->classLinker(TraversableFormInterface::class);
$inputInterface = Apis::apigen()->classLinker(InputInterface::class);
$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);

echo $parsedown->text(<<<MD
#HTML FORMS
$ns
Any HTML form object implement atleast $formIfLink interface. 
These Form objects are used to build UI and not to handle the form data submitted.

        
$formIfLink gives athe basic requirements for any form implementation. Whereas $traversableFormInterface 
extending $formIfLink is a container for any number of $inputInterface components.

MD
);
$load('Sphp.Html.Forms.InputInterface');

