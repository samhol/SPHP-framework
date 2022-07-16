<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\ContactForm;

use Sphp\Security\CRSFToken;
use Sphp\Security\ReCAPTCHAv3;
use Sphp\Apps\ContactForm\Views\FormView;
use Sphp\Apps\ContactForm\Views\ResultView;
use Sphp\Network\URL;
use Sphp\Network\Headers\GenericHeader;

/**
 * Implementation of Controller
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Controller {

  /**
   * @var ReCAPTCHAv3
   */
  private ReCAPTCHAv3 $reCaptchav3;

  /**
   * @var CRSFToken
   */
  private CRSFToken $crsfToken;

  /**
   * @var DataObject 
   */
  private DataObject $data;

  /**
   * @var DataObject
   */
  private $config;

  /**
   * @var ContactFormValidator 
   */
  private $validator;

  /**
   * @var ResultView
   */
  private ResultView $resultView;

  /**
   * @var FormView
   */
  private FormView $formView;

  /**
   * @var ContactDataMailer
   */
  private ContactDataMailer $mailer;

  public function __construct(DataObject $config) {
    $this->config = $config;
    $this->mailer = new ContactDataMailer(); //($this->config->from, $this->config->to);
    $this->mailer->setFrom($this->config->from->email, $this->config->from->name);
    foreach ($config->to as $to) {
      //var_dump($to);
      $this->mailer->addTo($to['email'], $to['name']);
    }
    $this->crsfToken = new CRSFToken();
    $this->reCaptchav3 = new ReCAPTCHAv3($this->config['reCAPTCHAv3']['site_key'], $this->config['reCAPTCHAv3']['secret']);
    $this->resultView = new ResultView();
    $this->formView = new FormView($this->config->form->action);
    $this->validator = new ContactFormValidator();
    $this->createDataObject();
  }

  private function createDataObject() {
    $this->data = new DataObject;
    //$this->data->valid = false;
    $this->data->validSubmission = false;
    $this->data->validTokens = false;
    $this->data->submitted = false;
    $this->data->errors = new DataObject;
  }

  public function __destruct() {
    unset(
            $this->config,
            $this->mailer,
            $this->crsfToken,
            $this->reCaptchav3,
            $this->data,
            $this->resultView,
            $this->formView,
            $this->validator);
  }

  public function getContactData(): DataObject {
    $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $formData = DataObject::fromArray($post);
    unset($formData->{'g-recaptcha-response'}, $formData->{'contact-form-token'});
    $this->data->validSubmission = true;
    if (!$this->validator->isValid($post)) {
      $this->data->validSubmission = false;
      $this->data->formData = $formData;
      $this->data->errors = $this->validator->getMessages()->toArray();
    }
    if ($this->data->validSubmission) {
      $this->data->formData = $formData;
    }
    return $formData;
  }

  public function parseDataFromSession(): ?DataObject {
    $data = null;
    if (array_key_exists('ContactFormResult', $_SESSION)) {
      $data = unserialize($_SESSION['ContactFormResult']);
      unset($_SESSION['ContactFormResult']);
    }
    if (!$data instanceof DataObject) {
      $data = null;
    }
    return $data;
  }

  public function verifyTokens(): bool {
    //$valid = true;
    $errors = [];
    $this->data->validTokens = true;
    if (!$this->crsfToken->verifyPostToken('contact-form-token')) {
      $errors['__tokens__'][] = 'Istuntosi on valitettavasti vanhentunut!';
      $this->data->validTokens = false;
    }
    try {
      $score = $this->reCaptchav3->getScoreFor('g-recaptcha-response');
      $this->data->humanScore = $score;
      if ($score <= 0.5) {
        $errors['__tokens__'][] = "Epäilyttävää toimintaa sulta sanoisin($score)!!";
        $this->data->validTokens = false;
      }
    } catch (\Exception $ex) {
      $errors['reCAPTCHA'][] = 'reCAPTCHA Tunnistautumisvirhe';
      $this->data->validTokens = false;
    }
    $this->data->errors = $errors;
    return $this->data->validTokens;
  }

  public function processFormSubmission(): void {
    if ($this->verifyTokens()) {
      //$this->data->addError('bööö');
      $contactData = $this->getContactData();
      if ($this->data->validSubmission) {
        $this->mailer->sendMessage($contactData);
        $this->data->submitted = true;
      }
    }
    //
    $_SESSION['ContactFormResult'] = serialize($this->data);
    //$_SESSION['post'] = $_POST;
    //print_r($_SESSION);
    $url = URL::getCurrent();

    $domain = $url->getHost();
    $sheme = $url->getScheme();
    (new GenericHeader('Location', "$sheme://$domain/contact-form/#vastaus"))->save();
  }

  public function doView(): string {
    echo '<script src="https://www.google.com/recaptcha/api.js"></script>' . '<script>
   function onSubmit(token) {
   var form = document.getElementById("demo-form");
   if (form.checkValidity()) {
     form.submit();
   }
   form.classList.add("was-validated");
   }
 </script>';

    $output = '';
    $data = $this->parseDataFromSession();
    if ($data !== null) {
      //print_r($data);
      if (!$data->validSubmission || !$data->validTokens) {
        $this->formView->setFormData($data->formData);
      }
      $output .= $this->resultView->generateResultCallout($data);
      unset($_SESSION['ContactFormResult']);
    }
    $form = $this->formView->buildForm();

    $this->crsfToken->insertIntoForm($form, 'contact-form-token');
    //$this->reCaptchav3->insertIntoForm($form, 'contact_form');
    $output .= $form;
    return $output;
  }

}
