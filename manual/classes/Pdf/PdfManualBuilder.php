<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\Pdf;

use Mpdf\Mpdf;
use Sphp\Html\Flow\Headings\HeadingInterface;

/**
 * Description of PdfManualBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class PdfManualBuilder {

  /**
   * @var Mpdf
   */
  private $mpdf;

  public function __construct() {
    $this->mpdf = new Mpdf(['mode' => 'utf-8']);
    $this->toc();

    $this->mpdf->SetTitle('SPHPlayground manual');
    $this->mpdf->SetHTMLHeader('<div style="text-align: right; font-weight: bold;">{PAGENO}/{nbpg}</div>');


    $this->mpdf->WriteHTML(file_get_contents('manual/css/pdf/pdf.css'), 1);
  }

  public function toc() {
    $this->mpdf->TOCpagebreakByArray([
        'tocfont' => 'FreeSansOblique.ttf',
        'tocfontsize' => '13px',
        'tocindent' => '13px',
    ]);
    $this->mpdf->h2toc = array(
        'H1' => 0,
        'H2' => 1,
        'H3' => 2
    );
  }

  public function insert(string $toc, int $level, string $content) {
    $this->mpdf->TOC_Entry($toc, $level);
    $sphp = '<div class="pdf">' . $content . '</div>';
    $this->mpdf->WriteHTML($sphp);
    $this->mpdf->AddPageByArray(array(
        'resetpagenum' => '0',
        'pagenumstyle' => 1,
        'suppress' => 'off',
    ));
    return $this;
  }

  public function generate() {
    $this->mpdf->Output();
  }

  public function insertHeading(string $heading): HeadingInterface {
    
  }

}
