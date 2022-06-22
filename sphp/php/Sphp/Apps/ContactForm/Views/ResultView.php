<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\ContactForm\Views;

use Sphp\Bootstrap\Components\Alert;
use Sphp\Html\Layout\Section;
use Sphp\Html\Layout\Aside;
use Sphp\Html\Lists\Ul;
use Sphp\Apps\ContactForm\DataObject;
use Sphp\Html\Forms\Label;
use Sphp\Html\PlainContainer;

/**
 * Result view
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ResultView {

  private DataObject $formData;

  public function __destruct() {
    unset($this->formData);
  }

  public function setMemberData(DataObject $memberData) {
    $this->formData = $memberData;
    return $this;
  }

  protected function generateErrorsContent(iterable $errorData): PlainContainer {
    //var_dump($errorData);
    $aside = new PlainContainer();
    $p = $aside->appendParagraph('<span class="icon"><i class="fas fa-exclamation-triangle fa-2x fa-fw"></i></span>');
    $p->append(' <strong>Errors in contact form:</strong>');
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
  protected function parseMessage(DataObject $data): PlainContainer {
    $aside = new PlainContainer();
    $aside->appendParagraph('<strong>You submitted the following data:</strong>');
    $ul = new Ul;
    $aside->append($ul);
    $ul->addCssClass('form-data');
    $ul->append("<strong>Name:</strong> {$data['name']}", true);
    $ul->append("<strong>Email address:</strong>  {$data['email']}");
    $phone = $data->phone ?? '-';
    $ul->append("<strong>Phone number:</strong> <var>$phone</var>");
    $ul->append("<strong>Message:</strong> <pre> {$data->message}</pre>");
    return $aside;
  }

  public function generateResultCallout(DataObject $data): Alert {
    $callout = new Alert();
    $callout->showDismissButton(true);
    $section = new Section();
    $callout->append($section);
    $callout->addCssClass('contact-application');
    if ($data->submitted) {
      $callout->addCssClass('alert-success');
      $section->appendH2('Thank you for your message')->setAttribute('id', 'answer');
      $section->appendParagraph('<strong>I\'ll get back to you as soon as possible</strong>');
      if ($data->formData !== null) {
        $section->append($this->parseMessage($data->formData));
      }
    } if (!$data->validTokens || !$data->validSubmission) {
      $callout->addCssClass('alert-danger');
      $section->appendH2('Valitettavasti lomakkeen lähettäminen epäonnistui!')->setAttribute('id', 'vastaus');
      if (isset($data->errors) && is_iterable($data->errors)) {
        $section->append($this->generateErrorsContent($data->errors));
      }
      $callout->addCssClass('error');
    }
    return $callout;
  }

}
