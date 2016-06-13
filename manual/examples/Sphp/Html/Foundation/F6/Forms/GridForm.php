<?php

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\Forms\Menus\MenuFactory as MenuFactory;
use Sphp\Html\Forms\Input\TextInput as TextInput;
use Sphp\Html\Forms\Radioboxes as Radioboxes;
use Sphp\Html\Forms\Checkboxes as Checkboxes;
use Sphp\Html\Forms\Textarea as Textarea;

$form = (new GridForm("sphpManual/pages/formSubmit.php", "post"))
		->setTarget("outputFrame")
		->appendHiddenVariable("page", "html.forms")
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
$address = new GridFieldset("ADDRESS:");
$form->append($address);
//$form["address"][0] = new Foundation\GridFieldset("Address");
$address[0] =
[
	new InputColumn((new TextInput("street"))
		->setPlaceholder("street address")
		->setLabel("Street address:"), 12, 6, 3),
	new InputColumn((new TextInput("zipcode", "", 5))
		->setPlaceholder("zip code")
		->setLabel("Zip code:")
		->setMaxlength(5), 12, 6, 3),
	new InputColumn((new TextInput("city"))
		->setPlaceholder("city")
		->setLabel("City:"), 12, 6, 3),
	new InputColumn(MenuFactory::getContentAsValueMenu(["Denmark", "Finland", "Iceland", "Norway", "Sweden"], "country")
		->setValue("Finland")
		->setLabel("Country:"), 12, 6, 3)
];
$boxes = new FormRow();
$boxes->appendColumn(new Radioboxes("gender", ["male", "female"], "Gender"), 12, 6);
$boxes->appendColumn(new Checkboxes("hobbies", ["basketball", "football", "cycling"], "Hobbies", true), 12, 6);
$form->append($boxes);
$form->append((new Textarea("notes", "", 4))
		->setPlaceholder("some notes about the person")
		->setLabel("Notes:"));

$form->printHtml();
?>
