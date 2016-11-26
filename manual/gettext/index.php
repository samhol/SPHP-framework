<?php

namespace Sphp\Html;

require_once('../settings.php');
require_once('../htmlHead.php');
require_once('GettextTable.php');

use Sphp\Core\I18n\Gettext\PoFileParser;
$p = new PoFileParser(\Sphp\LOCALE_PATH . '/fi_FI/LC_MESSAGES/Sphp.Defaults.po');
$gettextTable = new Tables\GettextTable($p->getAll());
$gettextTable->printHtml();

include('../_footer_.php');

use Sphp\Html\Apps\BackToTopButton;

(new BackToTopButton())
        ->setTitle('Back To Top')
        ->printHtml();
$html->documentClose();
