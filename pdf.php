<?php

require_once('manual/settings.php');

$mpdf = new \Mpdf\Mpdf();
$mpdf->SetHTMLHeader('
<div >
    <span style="float: left; font-weight: bold;">SPHPlayground manual</span> <span style="float: right; font-weight: bold;">{PAGENO}/{nbpg}</span>
</div>');

$mpdf->SetHTMLFooter('
<table width="100%" border="0">
    <tr>
        <td width="33%" style="border: none;">{DATE j-m-Y}</td>
        <td width="33%" align="center">{PAGENO}/{nbpg}</td>
        <td width="33%" style="text-align: right;">My document</td>
    </tr>
</table>');
$mpdf->Bookmark('Start of the document');


$css = '<style>' . file_get_contents('manual/css/pdf/pdf.css') . "</style>\n";
$html = $css . '<div class="pdf">' . Sphp\Manual\createPage('Sphp.Html') . '</div>';
$mpdf->WriteHTML('<div>Section 1 text</div>' . $html);

$mpdf->Output();
