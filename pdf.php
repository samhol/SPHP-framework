<?php

require_once('manual/settings.php');

$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8']);
$mpdf->TOCpagebreakByArray([
    'tocfont' => 'FreeSansOblique.ttf',
    'tocfontsize' => '13px',
    'tocindent' => '13px',
]);
$mpdf->SetTitle('SPHPlayground manual');
$mpdf->SetHTMLHeader('<div style="float: right; font-weight: bold;">{PAGENO}/{nbpg}</div>');
/* 
  $mpdf->SetHTMLFooter('
  <br><hr><br>
  <table width="100%" border="0">
  <tr>

  <td align="center">{PAGENO}/{nbpg}</td>
  </tr>
  </table>'); */
//$mpdf->Bookmark('Start of the document');

$mpdf->WriteHTML(file_get_contents('manual/css/pdf/pdf.css'), 1);
//$css = '<style>' . file_get_contents('manual/css/pdf/pdf.css') . "</style>\n";
//$mpdf->WriteHTML('Introduction');

$mpdf->AddPageByArray(array(
    'resetpagenum' => '1',
    'pagenumstyle' => 1,
    'suppress' => 'off',
));
$mpdf->TOC_Entry("HTML introduction", 0);
$html = '<div class="pdf">' . Sphp\Manual\createPage('Sphp.Html') . '</div>';
$mpdf->WriteHTML($html);
$mpdf->TOC_Entry("HTML Meta", 1);

$media = '<div class="pdf">' . Sphp\Manual\createPage('Sphp.Html.Head') . '</div>';
$mpdf->WriteHTML($media);
$mpdf->TOC_Entry("HTML Lists", 1);
$lists = '<div class="pdf">' . Sphp\Manual\createPage('Sphp.Html.Lists') . '</div>';
$mpdf->WriteHTML($lists);
$mpdf->TOC_Entry("HTML Media components", 1);
$media = '<div class="pdf">' . Sphp\Manual\createPage('Sphp.Html.Media') . '</div>';
$mpdf->WriteHTML($media);
$mpdf->TOC_Entry("I18n", 0);
$media = '<div class="pdf">' . Sphp\Manual\createPage('Sphp.I18n') . '</div>';
$mpdf->WriteHTML($media);

$mpdf->Output();
