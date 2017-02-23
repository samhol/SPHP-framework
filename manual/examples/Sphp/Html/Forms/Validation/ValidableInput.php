<?php

namespace Sphp\Core\Validators;

use Sphp\Localization\Locale as Locale;

Locale::setMessageLocale("fi_FI");
//Translator::bindTextDomain("validation");

$validator = (new FormValidator())
		->appendValidator("username", new RequiredValueValidator())
		->appendValidator("fname", new StringLengthValidator(2, 6))
		->appendValidator("lname", new RequiredValueValidator())
		->appendValidator("zipcode", new StringLengthValidator(5, 5))
		->appendValidator("password1", (new PasswordValidator())->allowEmptyValues())
		->appendValidator("password2", (new PasswordValidator())->allowEmptyValues());

namespace Sphp\Html\Forms;

use Sphp\Html\Forms\Foundation\GridForm as GridForm;

$form = (new GridForm(\Sphp\Stdlib\Path::get()->http(), "get"))->identify(); //->setFormValidator($validator);
$formValidator = new ValidableForm($form);
$form->appendHiddenVariable("page", "html.forms");

namespace Sphp\Html\Forms\Inputs;

$form["namefields"] = [
			(new TextInput("username", "", 50, 30))
			->setRequired(true)
			//->setValidationPattern(\Sphp\Util\Strings::FI_ZIPCODE_PATTERN)
			->setLabel("Username:")
			->setPlaceholder("username"),
			(new TextInput("fname", "", 50, 30))
			->setRequired(true)
			->setLabel("First name:")
			->setPlaceholder("first name"),
			(new TextInput("lname", "", 50, 30))
			->setRequired(true)
			->setLabel("Last name:")
			->setPlaceholder("last name")];
$form["lname"] = (new TextInput("zipcode", "sss22", 5, 5))
		->setLabel("Zipcode:")
		->setPlaceholder("zipcode");


$formValidator->buildDefaultValidator()->validate()->visualizeValidation()->printHtml();
?>