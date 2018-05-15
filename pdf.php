<?php

require_once('manual/settings.php');
$_SESSION['doc_type'] = 'pdf';

use Sphp\Manual\Pdf\PdfManualBuilder;

$pdfMan = new PdfManualBuilder();

$pdfMan->insert('Introduction', 0, Sphp\Manual\createPage('Sphp'))
        ->insert('HTML Introduction', 0, Sphp\Manual\createPage('Sphp.Html'))
        ->insert('HTML Meta', 1, Sphp\Manual\createPage('Sphp.Html.Head'))
        ->insert('HTML Lists', 1, Sphp\Manual\createPage('Sphp.Html.Lists'))
        ->insert('HTML Media components', 1, Sphp\Manual\createPage('Sphp.Html.Media'))
        ->insert('I18n', 0, Sphp\Manual\createPage('Sphp.I18n'))
        ->insert('Database', 0, Sphp\Manual\createPage('Sphp.Database'))
        ->generate();

unset($_SESSION['doc_type']);
