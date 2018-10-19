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
class WhitelistValidator extends AbstractValidator {

  const ILLEGAL_KEY = '_illegal_key_';

  /**
   * @var array
   */
  private $whitelist = [];

  /**
   * Constructs a new validator
   * 
   * @param array $whitelist
   */
  public function __construct(array $whitelist = []) {
    parent::__construct('Array expected');
    $this->setMessageTemplate(self::ILLEGAL_KEY, 'An illegal key found');
    $this->setWhitelist($whitelist);
  }

  public function getWhitelist(): array {
    return $this->whitelist;
  }

  public function setWhitelist(array $whitelist) {
    $this->whitelist = $whitelist;
    return $this;
  }

  public function isValid($param): bool {
    if (!is_array($param)) {
      $this->errorFromTemplate(self::INVALID);
      return false;
    }
    foreach ($param as $key => $item) {
      if (!in_array($key, $this->whitelist)) {
        $this->errorFromTemplate(self::ILLEGAL_KEY);
        return false;
      }
    }
    return true;
  }

}
