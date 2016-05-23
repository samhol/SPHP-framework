<?php

namespace Sepia;

$poParser = new PoParser();
$poParser->parseFile(__DIR__ . "/../../sph/locale/fi_FI/LC_MESSAGES/" . \Sphp\DEFAULT_DOMAIN . ".po");
$entries = $poParser->entries();
$msgids = array_keys($entries);


$input = preg_quote($search, '~'); // don't forget to quote input string!

$result = preg_grep('~' . $input . '~', $msgids);
print_r(array_keys($result));

echo "<pre>";

//print_r($poParser->getHeaders());
print_r($entries);
echo "</pre>";
namespace Sphp\Tools;

//echo "aassa<pre>";
//include_once 'sph/settings.php';
$f = new FileObject(__DIR__ . "/../../sph/locale/fi_FI/LC_MESSAGES/" . \Sphp\DEFAULT_DOMAIN . ".po");
//print_r($f );
$rows = array_slice($f->getTextFileRows(), 16);
//print_r($rows);
$arr = [];
$orig = [];
$translations = [];
$i = 0;
$j = 0;
foreach ($rows as $row) {
	$str = new String($row); //Strings::startsWith($row, 'msgid "');
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

foreach ($arr as $group => $data) {
	if (count($data) > 0) {
		$table = (new Table())->addCssClass("html-to-php");
		$table->thead()->append(["row:", "Message", "Translation"]);
		$body = $table->tbody();
		if ($group !== "Month names") {
			sort($data);
		}
		foreach ($data as $id => $row) {
			$tr = new Tr();
			$tr[] = new Th(($id + 1) . ".");
			$tr[] = $row[1];
			$tr[] = $row[2];
			$body[] = $tr;
		}
		(new \Sphp\Html\SingleAccordion($group, $table))->printHtml();
	}
}

$input = preg_quote('a', '~'); // don't forget to quote input string!

$result = preg_grep('~' . $input . '~', $orig);
//print_r($orig);
//print_r($result);
print_r(array_keys($result));
?>