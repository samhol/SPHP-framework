<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

use Sphp\Stdlib\MessageManager;

/**
 * Validates given form data
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class MapValidator extends AbstractValidator {

  /**
   * `ID` for invalid map data type error message
   */
  const NOT_MAP_DATA = 'INVALID_MAP_DATA';

  /**
   * inner validators
   * 
   * @var Validator[]
   */
  private array $validators;

  /**
   * Constructs a new validator
   *
   * @param string $message
   */
  public function __construct(string $message = 'Dataset contains invalid values') {
    parent::__construct($message);
    $this->validators = [];
    $this->messages->setTemplate(self::NOT_MAP_DATA, 'Value of :type type given. An array expected');
  }

  public function __destruct() {
    unset($this->validators);
    parent::__destruct();
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link https://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->validators = Arrays::copy($this->validators);
    parent::__clone();
  }

  public function isValid(mixed $value): bool {
    $this->setValue($value);
    if (!is_array($value)) {
      $this->setError(self::NOT_MAP_DATA);
      return false;
    }
    $valid = true;
    foreach ($this->validators as $inputName => $validator) {
      $inputValue = $value[$inputName] ?? null;
      if (!$validator->isValid($inputValue)) {
        if ($valid) {
          $valid = false;
          $this->setError(self::INVALID);
        }
      }
    }
    if (!$valid) {
      // $this->errors()->appendErrorFromTemplate(self::INVALID);
    }
    return $valid;
  }

  /**
   * Checks whether any validators exists for the input name
   * 
   * @param  string $inputName the name of the validable input
   * @return bool true if the input name has validators attached to it, false if not
   */
  public function hasValidator(string $inputName): bool {
    return isset($this->validators[$inputName]);
  }

  /**
   * Returns the validator object of the named input value
   * 
   * @param  string $inputName the name of the validable input
   * @return Validator|null the validator object or null
   */
  public function getValidator(string $inputName): ?Validator {
    if ($this->hasValidator($inputName)) {
      return $this->validators[$inputName];
    }
    return null;
  }

  /**
   * Sets a validator object for the named input value
   * 
   * @param  string $inputName the name of the validable input
   * @param  Validator $validator the validator object
   * @return $this for a fluent interface
   */
  public function setValidator(string $inputName, Validator $validator) {
    $this->validators[$inputName] = $validator;
    return $this;
  }

  public function getMapMessages(): MessageManager {
    $errors = new MessageManager();
    foreach ($this->validators as $inputName => $validator) {
      if ($validator->getMessages()->count() > 0) {
        $errors->setMessages($inputName, $validator->getMessages());
      }
    }
    return $errors;
  }

}
