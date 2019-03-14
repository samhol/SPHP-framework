<?php

use Sphp\I18n\Gettext\PoFileIterator;
use Sphp\Stdlib\Filesystem;
echo '<pre>';
$pos = PoFileIterator::parseFrom(Filesystem::getFullPath('sphp/locale/fi_FI/LC_MESSAGES/Sphp.Defaults.po'));
var_dump($pos->toArray());
echo '</pre>';
