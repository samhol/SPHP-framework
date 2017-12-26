<?php

namespace Sphp\Html\Forms;

use Sphp\Html\Forms\Foundation\GridForm;
use Sphp\Html\Forms\Foundation\InputColumn;

$fieldset = new Foundation\GridFieldset("Search messages:");
$ruleMenu = (new Select\Select("rule"));
		$ruleMenu->appendOption("starts", "Starts with:");
		$ruleMenu->appendOption("contains", "Contains:", TRUE);
		$ruleMenu->appendOption("ends", "Ends with:");
		//->setLabel("Search rule:");

$searchInput = (new Input\TextInput("search"))
		->setSize(30)
		->setRequired()
		->setPlaceholder("Search for messages containing text");
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
$fieldset[] = (new InputColumn((new Buttons\SubmitInput("Submit", "submit", "submitted"))
			->addCssClass("button success radius"), 12))->addCssClass("text-center");
$form = new Form($_SERVER["PHP_SELF"], "get");
$form->appendHiddenVariable("page", 1);
$form->append($fieldset)->setData($_GET)->printHtml();


