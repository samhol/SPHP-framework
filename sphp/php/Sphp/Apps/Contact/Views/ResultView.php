<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Contact\Views;

use Sphp\Html\Foundation\Sites\Containers\ContentCallout;
use Sphp\Html\Flow\Section;
use Sphp\Html\Flow\Aside;
use Sphp\Html\Lists\Ul;
use ATC\Contact\DataObject;
use Sphp\Html\Forms\Label;

/**
 * Result view
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ResultView {

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

  protected function generateErrorsContent(iterable $errorData): Aside {
    //var_dump($errorData);
    $aside = new Aside();
    $p = $aside->appendParagraph('<span class="icon"><i class="fas fa-exclamation-triangle fa-2x fa-fw"></i></span>');
    $p->append(' <strong>lomakkeessa olevat virheet:</strong>');
    $list = new Ul();
    $aside->append($list);
    foreach ($errorData as $input => $errors) {
      //var_dump($input, $errors);
      if (is_iterable($errors)) {
        foreach ($errors as $message) {
          $list->append(new Label($message, $input));
        }
      } else if (is_string($errors)) {
        $list->append(new Label($errors));
      }
    }
    return $aside;
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
      $ul->append("<strong>Viesti:</strong> <pre> {$data['message']}</pre>");
    }
    return $aside;
  }

  public function generateResultCallout(DataObject $data): ContentCallout {
    $callout = new ContentCallout();
    $callout->setClosable();
    $section = new Section();
    $callout->append($section);
    $callout->addCssClass('contact-application');
    if ($data->submitted) {
      $callout->addCssClass('successfull');
      $section->appendH2('Kiitos viestistäsi')->setAttribute('id', 'vastaus');
      $section->appendParagraph('<strong>Palaamme asiaan mahdollisimman pian</strong>');
      if ($data->formData !== null) {
        $section->append($this->parseMessage($data->formData));
      }
    } if (!$data->validTokens || !$data->validSubmission) {
      $callout->addCssClass('failure');
      $section->appendH2('Valitettavasti lomakkeen lähettäminen epäonnistui!')->setAttribute('id', 'vastaus');
      if (isset($data->errors) && is_iterable($data->errors)) {
        $section->append($this->generateErrorsContent($data->errors));
      }
      $callout->addCssClass('error');
    }
    return $callout;
  }

}
