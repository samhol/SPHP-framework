<?php

use Sphp\I18n\Gettext\TraversableCatalog;
use Sphp\Stdlib\Filesystem;

echo Sphp\Manual\md('# Gettext <small>search engine</small>');

$controller = new \Sphp\Manual\MVC\Gettext\Controller(TraversableCatalog::parseFrom(Filesystem::getFullPath('sphp/locale/fi_FI/LC_MESSAGES/Sphp.Defaults.po')));

$controller->buildView();