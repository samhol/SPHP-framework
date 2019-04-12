<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Security;

use Sphp\Exceptions\InvalidStateException;
use Sphp\Html\Forms\Form;

/**
 * Implementation of ReCAPTCHAv3
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ReCAPTCHAv3 {

  private $secret;
  private $clienId;

  public function __construct(string $clientId, string $secret) {
    $this->clienId = $clientId;
    $this->secret = $secret;
  }

  public function insertIntoForm(Form $form, string $formId) {
    $form->setAttribute('id', $formId);
    echo new \Sphp\Html\Scripts\ScriptSrc("https://www.google.com/recaptcha/api.js?render={$this->clienId}");
    $form->setAttribute('data-sphp-grecaptcha-v3', 'g-recaptcha-response');
    $form->setAttribute('data-sphp-grecaptcha-v3-clientId', $this->clienId);
    return $this;
  }

  /**
   * Returns the score for this request
   * 
   * @return float the score for this request (0.0 - 1.0)
   */
  public function getScoreFor(string $action = 'g-recaptcha-response'): float {
    $response = filter_input(INPUT_POST, $action, FILTER_SANITIZE_STRING);
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $this->secret,
        'response' => $response
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
      throw new InvalidStateException($codes);
    }
    return $responseData->score;
  }

}
