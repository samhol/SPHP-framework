<?php

use Sphp\I18n\Gettext\PoFileIterator;
use Sphp\Stdlib\Filesystem;

echo Sphp\Manual\md('# Gettext <small>search engine</small>');

$controller = new \Sphp\Manual\MVC\Gettext\Controller(PoFileIterator::parseFrom(Filesystem::getFullPath('sphp/locale/fi_FI/LC_MESSAGES/Sphp.Defaults.po')));

$controller->buildView();