<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Contact\Views;

/**
 * Class SuccesfullSubmissionView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class SuccesfullSubmissionView extends SubmissionView {

  /**
   * @var DataObject 
   */
  private $formData;

  public function __construct() {
    
  }

  public function __destruct() {
    unset($this->formData);
  }

  public function setMemberData(DataObject $memberData) {
    $this->formData = $memberData;
    return $this;
  }
  
  

  /**
   * 
   * @param  DataObject $data
   * @return string personal data as HTML
   */
  protected function parseMessage(DataObject $data): Aside {
    $aside = new Aside();
    $aside->appendParagraph('<strong>Lähettämäsi tiedot:</strong>');
    $ul = new Ul;
    $aside->append($ul);
    $ul->addCssClass('form-data');
    $ul->appendMd("<strong>Nimi:</strong> {$data['name']}", true);
    $ul->append("<strong>Sähköpostiosoite:</strong>  {$data['email']}");
    if ($data->phone !== null) {
      $ul->append("<strong>Puhelinnumero:</strong>  {$data['phone']}");
    }
    if ($data->message !== null) {
      $ul->append("<strong>Viesti:</strong>  {$data['message']}");
    }
    return $aside;
  }


  public function generateContent($data): \Sphp\Html\Flow\Section {
    $section = new Section();
    $section->appendH2('Kiitos viestistäsi')->setAttribute('id', 'vastaus');
    $section->appendParagraph('<strong>Palaamme asiaan mahdollisimman pian</strong>');
    if ($data !== null) {
      $section->append($this->parseMessage($data->formData));
    }
    return $section;
  }

}
