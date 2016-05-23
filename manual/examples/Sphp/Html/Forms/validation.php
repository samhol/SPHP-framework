<?php

namespace Sphp\Html\Forms;

use Sphp\Html\Forms\Foundation\GridForm as GridForm;
use Sphp\Html\Forms\Select\MenuFactory as MenuFactory;
use Sphp\Html\Forms\Input\TextInput as TextInput;
use Sphp\Html\Forms\Foundation\InputColumn as InputColumn;
use Sphp\Html\Forms\Radioboxes as Radioboxes;
use Sphp\Html\Forms\Checkboxes as Checkboxes;
use Sphp\Html\Forms\Textarea as Textarea;
use Sphp\Html\Forms\Buttons\SubmitButton as SubmitButton;

//use Sphp\Html\Forms\Textarea as Textarea;

$usernameInput = (new TextInput("username"))
		->setMaxlength(10)
		->setSize(10)
		->setRequired()
		->setPattern("/^([0-9a-zA-Z])*$/")
		->setPlaceholder("Username")
		->setLabel("Username:");


$radioBoxes = (new Radioboxes("gender", [
	"m" => "male",
	"f" => "female",
	"?" => "unknown"], "Gender"))
		->disable();
$checkBoxes = (new Checkboxes("hobbies", [
	"bball" => "Basketball",
	"football" => "Football",
	"cycling" => "Cycling",
	"running" => "Running",
	"swimming" => "Swimming",
	"lifting" => "Weightlifting"
		], "Hobbies", true));

$form = (new GridForm("sphpManual/pages/formSubmit.php", "post"))->validable(TRUE);

$form[] = [
	new InputColumn($usernameInput, 12, 4, 4),
	new InputColumn($radioBoxes, 12, 4, 4)];

$form[] = $checkBoxes;

$form[] = (new Textarea("textarea", "", 4))
		->setPlaceholder("&lt;textarea&gt;")
		->setLabel("Notes:");
//$form[] = (new InputColumn((new SubmitButton("Submit", "submit", "submitted"))->addCssClass("button tiny success radius")))->addCssClass("panel");

$form->printHtml();
?>