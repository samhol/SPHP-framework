<?php

namespace Sphp\Util;

//echo "aassa<pre>";
include_once '../settings.php';
include_once '../htmlHead.php';
echo '<body class="manual" id="manual-body">';
use Sphp\Stdlib\Filesystem;
$f = Filesystem::getTextFileRows(__DIR__ . "/../../sphp/locale/fi_FI/LC_MESSAGES/Sphp.Defaults.po");
echo "<pre>";
print_r($f );
$rows = array_slice($f, 16);
//print_r($rows);
$arr = [];
$orig = [];
$translations = [];
$i = 0;
$j = 0;
foreach ($rows as $row) {
	$str = new \Sphp\Stdlib\MbString($row); //Strings::startsWith($row, 'msgid "');
	if ($str->startsWith('#') && !$str->startsWith('#,') && !$str->startsWith('#Sami Holck')) {
		echo $row;
		$key = $str->replace('#', "", 1)->trim()->__toString();
		$i = 0;
	}
	//$arr[$i][1] = $str->replace('msgid "', "")->rtrim('"');
	if ($str->startsWith('msgid')) {
		$arr[$key][$i][1] = $str->replace('msgid', "")->trim(' "');
		$orig[] = $str->replace('msgid', "")->trim(' "');
	}if ($str->startsWith('msgstr ')) {
		$arr[$key][$i++][2] = $str->replace('msgstr', "")->trim(' "');
		$translations[] = $str->replace('msgid', "")->trim(' "');
	}
}

function cleanString(String $string) {
	return $string->replace(['msgid', 'msgstr'], "")->trim(' "');
}

//print_r($arr);

namespace Sphp\Html\Tables;
use Sphp\Html\Foundation\Sites\Containers\Accordions\Accordion as Accordion;
$accordion = new Accordion();
foreach ($arr as $group => $data) {
	if (count($data) > 0) {
		$table = (new Table())->addCssClass("html-to-php");
		$table->thead()->append(Tr::fromThs(["row:", "Message", "Translation"]));
		$body = $table->tbody();
		if ($group !== "Month names") {
			sort($data);
		}
		foreach ($data as $id => $row) {
			$tr = new Tr();
			$tr->append(new Th(($id + 1) . "."));
			$tr->appendThs($row[1]);
			$tr->appendThs($row[2]);
			$body->appendBodyRow($tr);
		}
    $accordion->appendPane($group, $table);
	}
}
$accordion->printHtml();
$input = preg_quote('a', '~'); // don't forget to quote input string!

$result = preg_grep('~' . $input . '~', $orig);
//print_r($orig);
//print_r($result);
//print_r(array_keys($result));
  $html->documentClose();

namespace Sepia;


$fileHandler = new FileHandler(__DIR__ . "/../../sphp/locale/fi_FI/LC_MESSAGES/Sphp.Defaults.po");
$poParser = new PoParser($fileHandler);
$entries  = $poParser->parse();
echo "<pre>";
print_r($entries);
echo "</pre>";
