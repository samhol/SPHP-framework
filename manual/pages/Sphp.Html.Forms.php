<?php

namespace Sphp\Html\Forms;

use Sphp\Html\Forms\Input\TextualInput as TextualInput;
use Sphp\Html\Forms\Input\Checkbox as Checkbox;
use Sphp\Html\Forms\Input\Radiobox as Radiobox;

$formIfLink = $api->getClassLink(FormInterface::class);
$inputInterface = $api->getClassLink(InputInterface::class);

$sphpScripts->appendSrc("manual/js/formTools.js");
$ns = $api->getNamespaceBreadGrumbs(__NAMESPACE__);

//(new \Sphp\Html\Programming\ScriptSrc("manual/js/formTools.js"))->printHtml();
echo $parsedown->text(<<<MD
#HTML FORMS
$ns
HTML forms are implemented in the framework using Classes implementing 
$formIfLink interface. They are used to pass user input data to a server just 
like their counterparts in actual HTML forms.
		
$formIfLink is the container for all $inputInterface components like 
({$api->getClassLink(TextualInput::class)}, {$api->getClassLink(Checkbox::class)}, {$api->getClassLink(Radiobox::class)}, submit buttons and more.
A form can also contain select lists, textarea, fieldset, legend, and label elements.
		
An HTML form is a section of a document containing normal content, markup, 
special elements called controls (checkboxes, radio buttons, menus, etc.), and 
labels on those controls. Users generally "complete" a form by modifying its 
controls (entering text, selecting menu items, etc.), before submitting the form 
to an agent for processing (e.g., to a Web server, to a mail server, etc.)

Sphp Form components implement HTML forms components

##Form components explained

###The $inputInterface and its implementors

These components can be used within a $formIfLink to declare input controls that allow 
users to input data. An input component extending $formIfLink can vary in many ways. 
		
All of the following components implement atleast $inputInterface and are therefore 
suitable to declare input controls in $formIfLink forms.

MD
);
$load("Sphp.Html.Forms.InputInterface.php");

