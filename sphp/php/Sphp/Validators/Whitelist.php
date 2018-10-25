<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

/**
 * Validates keys of an array against a whitelist
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Whitelist extends AbstractValidator {

  const ILLEGAL_KEY = '_illegal_key_';

  /**
   * @var array
   */
  private $whitelist = [];

  /**
   * Constructs a new validator
   * 
   * @param array $whitelist
   * @param string $errorText
   */
  public function __construct(array $whitelist, string $errorText = 'An illegal key found') {
    parent::__construct('Array expected');
    $this->errors()->setTemplate(self::ILLEGAL_KEY, $errorText);
    $this->setWhitelist($whitelist);
  }
  
  public function __destruct() {
    unset($this->whitelist);
    parent::__destruct();
  }

  public function getWhitelist(): array {
    return $this->whitelist;
  }

  public function setWhitelist(array $whitelist) {
    $this->whitelist = $whitelist;
    return $this;
  }

  public function isValid($value): bool {
    $this->setValue($value);
    if (!is_array($value)) {
      $this->errors()->appendErrorFromTemplate(self::INVALID);
      return false;
    }
    foreach (array_keys($value) as $key) {
      if (!in_array($key, $this->whitelist, true)) {
        $this->errors()->appendErrorFromTemplate(self::ILLEGAL_KEY);
        return false;
      }
    }
    return true;
  }

}
