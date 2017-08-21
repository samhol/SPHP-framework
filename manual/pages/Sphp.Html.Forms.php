<?php

namespace Sphp\Html\Forms;

use Sphp\Html\Forms\Inputs\InputInterface;
use Sphp\Html\Apps\Manual\Apis;

$formIfLink = Apis::sami()->classLinker(FormInterface::class);
$traversableFormInterface = Apis::sami()->classLinker(TraversableFormInterface::class);
$inputInterface = Apis::sami()->classLinker(InputInterface::class);
$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);

\Sphp\Manual\parseDown(<<<MD
#HTML FORMS
$ns
Any HTML form object implement atleast $formIfLink interface. 
These Form objects are used to build UI and not to handle the form data submitted.

        
$formIfLink gives athe basic requirements for any form implementation. Whereas $traversableFormInterface 
extending $formIfLink is a container for any number of $inputInterface components.

MD
);
\Sphp\Manual\loadPage('Sphp.Html.Forms.InputInterface');

