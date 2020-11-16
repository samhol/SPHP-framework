<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Security;

use Sphp\Html\Forms\Form;
use Sphp\Security\Exception\ReCAPTCHAException;
use Sphp\Html\Scripts\ExternalScript;

/**
 * Implementation of Google reCAPTCHA v3
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @link    https://developers.google.com/recaptcha/docs/v3 reCAPTCHA v3
 * @filesource
 */
class ReCAPTCHAv3 {

  /**
   * @var string 
   */
  private $secret;

  /**
   * @var string 
   */
  private $clienId;

  /**
   * Constructor
   * 
   * @param string $clientId
   * @param string $secret
   */
  public function __construct(string $clientId, string $secret) {
    $this->clienId = $clientId;
    $this->secret = $secret;
  }

  /**
   * 
   * @return string
   */
  public function getSecret(): string {
    return $this->secret;
  }

  /**
   * 
   * @return string
   */
  public function getClienId(): string {
    return $this->clienId;
  }

  /**
   * 
   * @param  Form $form
   * @param  string $formId
   * @return $this for a fluent interface
   */
  public function insertIntoForm(Form $form, string $formId) {
    $form->setAttribute('id', $formId);
    echo new ExternalScript("https://www.google.com/recaptcha/api.js?render={$this->getClienId()}");
    $form->setAttribute('data-sphp-grecaptcha-v3', 'g-recaptcha-response');
    $form->setAttribute('data-sphp-grecaptcha-v3-clientId', $this->getClienId());
    return $this;
  }

  /**
   * Returns the score for this request
   * 
   * @param string $response
   * @return float the score for this request (0.0 - 1.0)
   * @throws ReCAPTCHAException if fetching fails
   */
  public function getScoreForResponse(string $response = null): float {
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $this->getSecret(),
        'response' => (string) $response
    ];
    $query = http_build_query($data);
    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => $query
        ]
    ];
    $context = stream_context_create($options);
    $verify = file_get_contents($url, false, $context);
    $responseData = json_decode($verify);

    //$_SESSION['contact_form']['responseData'] = $responseData;
    if (!$responseData->success) {
      //var_dump($responseData);
      $codes = implode(', ', $responseData->{'error-codes'});
      //$codes ='foo';
      throw new ReCAPTCHAException($codes);
    }
    return $responseData->score;
  }

  /**
   * Returns the score for this request
   * 
   * @return float the score for this request (0.0 - 1.0)
   * @deprecated since version 1.0.0
   */
  public function getScoreFor(string $action = 'g-recaptcha-response'): float {
    $response = filter_input(INPUT_POST, $action, FILTER_SANITIZE_STRING);
    return $this->getScoreForResponse($response);
  }

}
