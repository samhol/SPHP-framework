<?php

namespace Sphp\Html\Forms;

use Sphp\Html\Forms\Inputs\Input;
use Sphp\Manual;

$formIfLink = Manual\api()->classLinker(FormInterface::class);
$traversableFormInterface = Manual\api()->classLinker(TraversableForm::class);
$inputInterface = Manual\api()->classLinker(Input::class);
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

\Sphp\Manual\md(<<<MD
#HTML FORMS
$ns
Any HTML form object implement atleast $formIfLink interface. 
These Form objects are used to build UI and not to handle the form data submitted.
   
$formIfLink gives athe basic requirements for any form implementation. Whereas $traversableFormInterface 
extending $formIfLink is a container for any number of $inputInterface components.

MD
);
\Sphp\Manual\loadPage('Sphp.Html.Forms.InputInterface');
\Sphp\Manual\loadPage('Sphp.Html.Forms.Buttons');



