<?php

namespace Sphp\Html\Forms;

use Sphp\Html\Forms\Foundation\GridForm as GridForm;
use Sphp\Html\Forms\Foundation\FormRow as FormRow;
use Sphp\Html\Forms\Menus\MenuFactory as MenuFactory;
use Sphp\Html\Forms\Input\TextInput as TextInput;
use Sphp\Html\Forms\Foundation\InputColumn as InputColumn;
use Sphp\Html\Forms\Buttons\SubmitButton as SubmitButton;

$form = (new GridForm("sphpManual/pages/formSubmit.php", "post"))
		->setTarget("outputFrame")
		->setHiddenVariable("page", "html.forms")
		->append([
	new InputColumn((new TextInput("username"))
			->setPlaceholder("Username")
			->setLabel("Username:"), 12, 4, 4),
	new InputColumn((new TextInput("fname"))
			->setPlaceholder("First name")
			->setLabel("First name:"), 12, 4, 4),
	new InputColumn((new TextInput("lname"))
			->setPlaceholder("Family name")
			->setLabel("Family name:"), 12, 4, 4)]);
$address = new Foundation\GridFieldset("ADDRESS:");
$form["address"] = $address;
//$form["address"][0] = new Foundation\GridFieldset("Address");
$address[0] =
[
	new InputColumn((new TextInput("street"))
		->setPlaceholder("street address")
		->setLabel("Street address:"), 12, 6, 3),
	new InputColumn((new input\TextInput("zipcode", "", 5))
		->setPlaceholder("zip code")
		->setLabel("Zip code:")
		->setMaxlength(5), 12, 6, 3),
	new InputColumn((new input\TextInput("city"))
		->setPlaceholder("city")
		->setLabel("City:"), 12, 6, 3),
	new InputColumn(MenuFactory::getContentAsValueMenu(["Denmark", "Finland", "Iceland", "Norway", "Sweden"], "country")
		->setValue("Finland")
		->setLabel("Country:"), 12, 6, 3)
];
$form["boxes"] = new FormRow();
$form["boxes"]->appendColumn(new Radioboxes("gender", ["male", "female"], "Gender"), 12, 6);
$form["boxes"]->appendColumn(new Checkboxes("hobbies", ["basketball", "football", "cycling"], "Hobbies", true), 12, 6);
$form[] = (new Textarea("notes", "", 4))
		->setPlaceholder("some notes about the person")
		->setLabel("Notes:");
//$form[] = (new InputColumn((new SubmitButton("Submit", "submit", "submitted"))))->addCssClass("panel");

$form->printHtml();
?>