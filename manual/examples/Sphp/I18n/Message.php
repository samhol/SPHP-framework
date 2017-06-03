<?php

namespace Sphp\I18n;

$translator = new Gettext\Translator('Sphp.Defaults', 'sphp/locale');
$msg = new Message("Please insert atleast %s of the following characters (%s)", [2, "a, b, c"]);
echo "message 3 in english: {$msg->setLang('en_US')}\n";
echo "message 3 in finnish: {$msg->setLang('fi_FI')->setArguments([4, 'a,b,c,d,e,f,g'])}\n";
$plural = new PluralMessage("%d file. Total size: At least %s", "%d files. Total size: At least %s", 1, [1, '100kb']);
echo "$plural\n";
$plural->isPlural(true)->setArguments([2, '100kb'])->setLang('fi_FI');
echo "$plural\n";
try {
  echo $msg->setArguments([4, 'a,b,c,d,e,f,g', 'foo'])->translate();
  echo $msg->setArguments([4])->translate();
  echo $msg->setArguments(['foo', 'bar'])->translate();
} catch (\Exception $ex) {
  var_dump($ex);
}
