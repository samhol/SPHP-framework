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

use Sphp\Html\Foundation\Sites\Containers\ContentCallout;
use Sphp\Html\Flow\Section;
use Sphp\Html\Flow\Aside;
use Sphp\Html\Lists\Ul;
use ATC\Contact\DataObject;
use Sphp\Html\Forms\Label;

/**
 * Class ResultCalloutView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ResultCalloutView {

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

  public function generateFailureCallout(DataObject $data): ContentCallout {
    $callout = new ContentCallout();
    $callout->setClosable();
    $section = new Section();
    $callout->append($section);
    $callout->addCssClass('contact-application');
    $callout->addCssClass('failure');
    $section->appendH2('Valitettavasti lomakkeen lähettäminen epäonnistui!')->setAttribute('id', 'vastaus');
    if (isset($data->errors) && is_iterable($data->errors)) {
      $section->append($this->generateErrorsContent($data->errors));
    }
    $callout->addCssClass('error');

    return $callout;
  }

  public function generateResultCallout(DataObject $data): ContentCallout {
    $callout = new ContentCallout();
    $callout->setClosable();
    $section = new Section();
    $callout->append($section);
    $callout->addCssClass('contact-application');
   $section->appendH2('Valitettavasti lomakkeen lähettäminen epäonnistui!')->setAttribute('id', 'vastaus');
   
    if (!$data->validTokens || !$data->validSubmission) {
      $p = $section->appendParagraph('<span class="icon"><i class="fas fa-exclamation-triangle fa-2x fa-fw"></i></span>');

      if (!$data->validTokens) {
        $p->append(' <strong>Istunnossa tapahtuneet virheet:</strong>');
      }
      if (!$data->validSubmission) {
        $p->append(' <strong>Lomakkeessa olevat virheet:</strong>');
      }
    }
    $callout->addCssClass('failure');
    $callout->addCssClass('error');
    if (isset($data->errors) && is_iterable($data->errors)) {
      $section->append($this->generateErrorsContent($data->errors));
    }

    return $callout;
  }

}
