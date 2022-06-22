<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Security;

use Sphp\Html\Forms\HtmlForm;
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

  private string $secret;
  private string $clienId;

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
   * @param  HtmlForm $form
   * @param  string $formId
   * @return $this for a fluent interface
   */
  public function insertIntoForm(HtmlForm $form, string $formId) {
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
  public function getScoreForResponse(string $response): float {
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $this->getSecret(),
        'response' => (string) $response
    ];
    $query = http_build_query($data);

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
        "Content-Type: application/x-www-form-urlencoded",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);


    curl_setopt($curl, CURLOPT_POSTFIELDS, $query);

//for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    var_dump($resp);

    
    
    
    $responseData = json_decode($resp);

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
