<?php

namespace Sphp\Html\Forms;

use Sphp\Html\Forms\Foundation\GridForm as GridForm;
use Sphp\Html\Forms\Foundation\InputColumn as InputColumn;

$fieldset = new Foundation\GridFieldset("Search messages:");
$ruleMenu = (new Select\Select("rule"))
		->appendOption("starts", "Starts with:")
		->appendOption("contains", "Contains:", TRUE)
		->appendOption("ends", "Ends with:");
		//->setLabel("Search rule:");

$searchInput = (new Input\TextInput("search"))
		->setSize(30)
		->setRequired()
		->setPlaceholder("Searrc for messages containing text");
		//->setLabel("A part of Message:");

$perPageOptions = [];
for ($i = 10; $i <= 50; $i += 10) {
	$perPageOptions[$i] = "Show $i results per page";
}

$perPage = (new Select\Select("view", $perPageOptions));
$fieldset[] = [
	new InputColumn($ruleMenu, 12, 3),
	new InputColumn($searchInput, 12, 6),
	new InputColumn($perPage, 12, 3)];
$fieldset[] = (new InputColumn((new Buttons\SubmitButton("Submit", "submit", "submitted"))
			->addCssClass("button success radius"), 12))->addCssClass("text-center");
$form = new Form($_SERVER["PHP_SELF"], "get");
$form->setHiddenVariable("page", 1);
$form->append($fieldset)->setData($_GET)->printHtml();

