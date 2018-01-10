<?php

namespace Sphp\Html\Forms;

use Sphp\Html\Forms\Inputs\Input;
use Sphp\Manual;

$formIfLink = Manual\api()->classLinker(FormInterface::class);
$traversableFormInterface = Manual\api()->classLinker(TraversableForm::class);
$inputInterface = Manual\api()->classLinker(Input::class);
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$w3c = Manual\w3schools();

Manual\md(<<<MD
#HTML FORMS
$ns
The HTML $w3c->form element represents a document section that contains interactive controls to submit information to a web server.

<div class="callout secondary" markdown="1">        
###NOTE

Form components in this framework are used to build User Interfaces and not to handle the form data submitted.      
</div>
All built-in HTML form objects implement atleast $formIfLink interface. This 
interface defines the basic form implementation. Whereas $traversableFormInterface 
is also container for HTML components like $inputInterface.

MD
);

Manual\loadPage('Sphp.Html.Forms.InputInterface');
Manual\loadPage('Sphp.Html.Forms.Buttons');
