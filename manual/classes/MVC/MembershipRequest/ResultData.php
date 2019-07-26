<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\MVC\MembershipRequest;

use Sphp\Exceptions\InvalidStateException;

/**
 * Description of ResultData
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ResultData {

  /**
   * @var string[] 
   */
  private $errors = [];

  /**
   * @var bool 
   */
  private $isSubmitted = false;

  /**
   * @var RequestData|null
   */
  private $formData;

  /**
   * @var float
   */
  private $humanScore = 0;

  public function __construct() {
    $this->errors = [];
  }

  public function __destruct() {
    //unset($this->formData, $this->errors);
  }

  public function isValid(): bool {
    return empty($this->errors);
  }

  public function getErrors(): array {
    return $this->errors;
  }

  public function getFormData(): ?RequestData {
    return $this->formData;
  }

  public function unsetErrors() {
    $this->errors = [];
    return $this;
  }

  public function setErrors(array $errors) {
    $this->errors = $errors;
    return $this;
  }

  public function addError(string $errors) {
    $this->errors[] = $errors;
    return $this;
  }

  public function setFormData(RequestData $formData = null) {
    $this->formData = $formData;
    return $this;
  }

  public function isSubmitted(): bool {
    return $this->isSubmitted;
  }

  /**
   * 
   * @param  bool $isSubmitted
   * @return $this for a fluent interface
   * @throws InvalidStateException
   */
  public function setSubmitted(bool $isSubmitted) {
    if (!$this->isValid()) {
      throw new InvalidStateException("Form data is invalid and cannot be send to server");
    }
    $this->isSubmitted = $isSubmitted;
    return $this;
  }

  public function getHumanScore(): float {
    return $this->humanScore;
  }

  public function setHumanScore(float $humanScore) {
    $this->humanScore = $humanScore;
    return $this;
  }

}
