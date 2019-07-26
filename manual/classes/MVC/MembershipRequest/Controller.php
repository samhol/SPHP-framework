<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\MVC\MembershipRequest;

use Sphp\Security\CRSFToken;
use Sphp\Security\ReCAPTCHAv3;
use Sphp\Stdlib\Datastructures\DataObject;
use Sphp\Manual\MVC\MembershipRequest\Views\FormView;
use Sphp\Manual\MVC\MembershipRequest\Views\ResultView;

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
  private $reCaptchav3;

  /**
   * @var CRSFToken
   */
  private $crsfToken;

  /**
   * @var ResultData 
   */
  private $data;

  /**
   * @var DataObject
   */
  private $config;

  /**
   * @var FormDataValidator 
   */
  private $validator;

  /**
   * @var ResultView
   */
  private $resultView;

  /**
   * @var FormView
   */
  private $formView;

  /**
   * @var ContactDataMailer
   */
  private $mailer;

  public function __construct(DataObject $config) {
    $this->config = $config;
    $this->mailer = new ContactDataMailer($this->config->form_email, $this->config->to);
    $this->crsfToken = new CRSFToken();
    $this->reCaptchav3 = new ReCAPTCHAv3($this->config->reCAPTCHAv3->site_key, $this->config['reCAPTCHAv3']['secret']);
    $this->data = new ResultData;
    $this->resultView = new ResultView();
    $this->formView = new FormView();
    $this->validator = new FormDataValidator();
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

  public function getContactData(): RequestData {
    $formData = new RequestData();
    //$this->data->setFormData($formData);
    $valid = true;
    if (!$this->validator->hasValidFieldsOnly($_POST)) {
      $valid = false;
    } else if (!$this->validator->isValidFormSubmission($_POST)) {
      $valid = false;
      $formData->fromArray($_POST);
      $this->data->setFormData($formData);
      //echo 'rgegergew';
    }
    if (!$valid) {
      $this->data->setErrors($this->validator->getErrors());
    }
    if ($valid) {
      $formData->fromArray($_POST);
      $this->data->setFormData($formData);
      $_SESSION['fd'] = $formData;
    }
    return $formData;
  }

  public function verifyTokens(): bool {
    $valid = true;
    if (!$this->crsfToken->verifyPostToken('rvs_contact_token')) {
      $this->data->addError('Istuntosi on valitettavasti vanhentunut!');
      $valid = false;
    }
    try {
      $score = $this->reCaptchav3->getScoreFor('g-recaptcha-response');
      $this->data->setHumanScore($score);
      if ($score <= 0.5) {
        $this->data->addError("Epäilyttävää toimintaa sulta sanoisin($score)!!");
        $valid = false;
      }
    } catch (\Exception $ex) {
      $this->data->addError('Tunnistamaton virhe: ' . $ex->getMessage());
      $valid = false;
    }
    $_SESSION['foo'] =  $this->data;
    return $valid;
  }

  public function process(): void {
    $this->getContactData();
    if ($this->verifyTokens()) {
      //$this->data->addError('bööö');
      if ($this->data->isValid()) {
        $this->mailer->sendMessage($this->data->getFormData());
        $this->data->setSubmitted(true);
      }
    }
    $_SESSION['MembershipFormResult'] = $this->data;
    //$_SESSION['post'] = $_POST;
  }

  public function doView(): string {
    $output = '';
    if (array_key_exists('MembershipFormResult', $_SESSION)) {
      $data = $_SESSION['MembershipFormResult'];
      if ($data instanceof ResultData) {
        if (!$data->isValid()) {
          // print_r($data->getFormData());
          $this->formView->setMemberData($data->getFormData());
        }
        $output .= $this->resultView->generateResultCallout($data);
      }
      unset($_SESSION['MembershipFormResult']);
    }
    $form = $this->formView->buildForm();
    $this->crsfToken->insertIntoForm($form, 'rvs_contact_token');
    $this->reCaptchav3->insertIntoForm($form, 'rvs_membership_form');
    $output .= $form;
    
        echo '<pre>';
        print_r($_SESSION);
        //var_dump($_SESSION);
        echo '</pre>';
    return $output;
  }

}
