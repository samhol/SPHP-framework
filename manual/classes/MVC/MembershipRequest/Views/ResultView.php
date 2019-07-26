<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\MVC\MembershipRequest\Views;

use Sphp\Html\Foundation\Sites\Containers\ContentCallout;
use Sphp\Html\Flow\Section;
use Sphp\Stdlib\Arrays;
use Sphp\Html\Lists\Ul;
use Sphp\MVC\MembershipRequest\ResultData;

/**
 * Result view
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ResultView {

  /**
   * @var ResultData 
   */
  private $memberData;

  /**
   * @var Views 
   */
  private $views;

  public function __construct() {
    $this->views = new Views();
  }

  public function getMemberData(): ResultData {
    return $this->memberData;
  }

  public function setMemberData(ResultData $memberData) {
    $this->memberData = $memberData;
    return $this;
  }

  public function generateResultCallout(ResultData $data): \Sphp\Html\Content {
    $callout = new ContentCallout();
    $callout->setClosable();
    $section = new Section();
    $callout->append($section);
    if ($data->isSubmitted()) {
      $callout->addCssClass('membership-application', 'successfull');
      $section->appendH3('Kiitos hakemuksestasi')->setAttribute('id', 'vastaus');
      $section->appendParagraph('Käsittelemme jäsenhakemuksesi mahdollisimman pian');
      $section->appendParagraph('<strong>Hakemuksen tiedot:</strong>');
  
      if ($data->getFormData() !== null) {
        $section->append($this->views->personToHtml($data->getFormData()));
      }
    } if (!$data->isValid()) {
      $callout->addCssClass('membership-application', 'failure');
      $section->appendH3('Valitettavasti lomakkeen lähettäminen epäonnistui!')->setAttribute('id', 'vastaus');
      $list = new Ul();
      $list->addCssClass('fa-ul');
      foreach (Arrays::flatten($data->getErrors()) as $error) {
        $list->append('<span class="fa-li"><i class="fas fa-exclamation-triangle"></i></span>' . $error);
      }
      $section->append($list);
      $callout->addCssClass('error');
    }
    //$callout->printHtml();
    return $callout;
  }

}
