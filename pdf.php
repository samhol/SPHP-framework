<?php

require_once('manual/settings.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Sami Holck <sami.holck@gmail.com>');
$pdf->SetTitle('SPHPlayground Manual');
$pdf->SetSubject('SPHPlayground Tutorial');
$pdf->SetKeywords('php, html, example, manual, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'SPHPlayground Manual', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// add a page
$pdf->AddPage();
$html = '<h4>SPHPlayground Manual</h4><p></p>';

$pdf->writeHTML($html, true, false, true, false, '');
// add a page
$pdf->AddPage();

$css = '<style>' . file_get_contents('manual/css/pdf/pdf.css') . "</style>\n";
$html = $css . '<div class="pdf">' . Sphp\Manual\createPage('Sphp.Html') . '</div>';
// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();
//echo $html;
//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');
