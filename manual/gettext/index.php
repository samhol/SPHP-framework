<?php

use Sphp\I18n\Gettext\PoFileIterator;
use Sphp\Stdlib\Filesystem;
use Sepia\PoParser\Catalog\Entry;
use Sphp\Manual\MVC\Gettext\GettextForm;

echo Sphp\Manual\md('# Gettext search engine');
/*
$form = new GettextForm();


echo $form->getHtml();


$pos = PoFileIterator::parseFrom(Filesystem::getFullPath('sphp/locale/fi_FI/LC_MESSAGES/Sphp.Defaults.po'));
if (isset($_GET['msgid'])) {
  $msgId = filter_input(INPUT_GET, 'msgid', FILTER_SANITIZE_SPECIAL_CHARS);
  echo "Searching for : $msgId";
  $cond1 = function(Entry $e) {
    $msgId = filter_input(INPUT_GET, 'msgid');
    return mb_strpos($e->getMsgId(), $msgId) !== false;
  };
  $pos = $pos->filter($cond1);
}
if (isset($_GET['msgstr'])) {
  $msgstr = filter_input(INPUT_GET, 'msgstr', FILTER_SANITIZE_SPECIAL_CHARS);
  echo "Searching for : $msgstr";
  $cond1 = function(Entry $e) {
    $msgId = filter_input(INPUT_GET, 'msgstr');
    return mb_strpos($e->getMsgStr(), $msgId) !== false;
  };
  $pos = $pos->filter($cond1);
}
//echo '<pre>';
$table = new Sphp\Manual\MVC\Gettext\GettextTable();
$cond = function(Entry $a, Entry $b) {
  return strcmp($a->getMsgId(), $b->getMsgId());
};
$pos->sort($cond);
echo $table->generate($pos);

//echo '</pre>';
//echo $table->generate($pos);*/
$controller = new \Sphp\Manual\MVC\Gettext\Controller(PoFileIterator::parseFrom(Filesystem::getFullPath('sphp/locale/fi_FI/LC_MESSAGES/Sphp.Defaults.po')));
//echo '</pre>';
$controller->buildView();