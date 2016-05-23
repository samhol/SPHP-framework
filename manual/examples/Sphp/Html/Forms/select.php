<?php

namespace Sphp\Html\Forms\Menus;

use Sphp\Html\Foundation\F6\Forms\GridForm as Form;

$select1 = (new Select("selector", new Option(1, "The first")))
		->append(new Option(2, "The second", true))
		->appendOption(3, "The third", true)
		->prepend(new Option(0, "The Prepended"));
$select1[] = new Option("4th", "The fourth");
$select1[] = ["5th" => "The fourth"];
//$clonedSelect = clone $select1;
//unset($select1[0]); //deletes an entry
$select2 = (new Select("cars[]"))
		->append(["Sweden" => [
						"saab" => "Saab",
						"volvo" => "Volvo"
					],
					"Germany" => [
						"audi" => "Audi",
						"bmw" => "BMW",
						"mb" => "Mercedes-Benz",
						"opel" => "Opel",
						"porsche" => "Porsche",
						"vw" => "Volkswagen"
					],
					"Italy" => [
						"ferrari" => "Ferrari",
						"fiat" => "Fiat"
					]])
		->setSize(5)
		->selectMultiple()
		->setSelectedValues(["audi", "porsche", "volvo"]);

$form = (new Form("manual/pages/formSubmit.php", "post"))
		->append([
			$select1,
			$select2,
			MenuFactory::monthMenu()->setSelectedValues([date("n")]),
			MenuFactory::rangeMenu(0, 15, 2, "range")->setSelectedValues(6)
		]);
$form->printHtml();

?>