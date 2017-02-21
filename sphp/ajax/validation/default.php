<?php

namespace Sphp\Localization;

header('Content-Type: application/json');
include_once(__DIR__ . "/../../settings.php");

Locale::setMessageLocale("fi_FI");
Translator::bindTextDomain("validation");
//$title = Translator::get("Errors") . ":";
$output["title"] = Translator::get("Errors") . ":";
//echo "<pre>";
//print_r($_GET);
//echo "/*_POST:\n";
//print_r($_GET);
//echo ":*/\n";

$op = filter_input(\INPUT_GET, "op", \FILTER_SANITIZE_STRING);
$name = filter_input(\INPUT_GET, "name", \FILTER_SANITIZE_STRING);
$value = filter_input(\INPUT_GET, "value");
//echo "*/"; 
//$errors = "[]";
//$hasErrors = "false";

namespace Sphp\Core\Validators;

//use Sphp\Stdlib\Strings;
$validator = new ValidatorAggregate();
//var_dump(isset($data["pattern"]));
/* if (is_string($data["pattern"])) {
  $v = new PatternValidator(Strings::htmlentities($data["pattern"]));
  if (isset($data["required"])) {
  $validator->forceValidation(true);
  $v->forceValidation(true);
  }
  if (!$v->validate($data["validate"])->isValid()) {
  $errors = $v->getErrors()->toJson();
  $hasErrors = "true";
  }
  } */
//var_dump($op);
//var_dump($value);
if ($op == "require") {
	$v = new RequiredValueValidator();
	$v->validate($value);
	//echo "\n//REQUIRED";
	//var_dump();
	if (!$v->isValid()) {
		//echo $v->getErrors();
		//print_r($v->getErrors()->getIterator()->getArrayCopy());
		$output["errors"] = $v->getErrors()->toArray();
		$output["valid"] = false;
	} else {
		$output["valid"] = true;
	}
}
//echo '{"title": "' . $title . '", "messages": ' . $errors . ', "hasErrors": ' . $hasErrors . '}';
//$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
echo json_encode($output);
/*namespace Sphp\Tools;

echo "value: " . Strings::htmlentities($get["value"]);
var_dump($get["value"]);
echo "\nnum validators:" . $validator->count();
echo "\nerrormessage count: " . $validator->validate($get["value"])->getErrors()->count();
echo "\n" . $v->validate($get["value"])->getErrors()->toJson();
//$validator->addValidator(new RequiredValueValidator());

var_dump(Strings::match(null, $get["pattern"]));
echo Strings::htmlentities("\nääööääööääöö" . $get["pattern"]);
echo "</pre>";


